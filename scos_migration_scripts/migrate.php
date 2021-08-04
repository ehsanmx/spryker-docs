<?php

define('SRC_DIR', 'src');
define('DEST_DIR', 'dest');

function loadFiles(string $path) {
    $fsIterator = new RecursiveDirectoryIterator($path);
    $iterator = new RecursiveIteratorIterator($fsIterator);

    /** @var \SplFileInfo $fileInfo */
    foreach ($iterator as $fileInfo) {
        if (!$fileInfo->isFile() || $fileInfo->getExtension() !== 'md') {
            continue;
        }

        yield $fileInfo;
    }
}

function buildFrontmatter(?string $meta) {
    if ($meta === null) {
        return '';
    }

    preg_match('/title: (.*)/m', $meta, $matches);
    $title = trim($matches[1]);
    
    preg_match('/original-url : (.*)/m', $meta, $matches);
    $originalUrl = trim($matches[1]);
    
    $frontMatter = '---' . PHP_EOL;
    $frontMatter .= 'title: ' . str_replace(':', '-', $title) . PHP_EOL;
    $frontMatter .= 'originalLink: ' . $originalUrl . PHP_EOL;
    $frontMatter .= 'redirect_from:' . PHP_EOL;
    $frontMatter .= '  - ' . str_replace('https://documentation.spryker.com', '', $originalUrl) . PHP_EOL;
    $frontMatter .= '  - ' . str_replace('/docs/', '/docs/en/', str_replace('https://documentation.spryker.com', '', $originalUrl)) . PHP_EOL;
    $frontMatter .= '---' . PHP_EOL;
    
    return $frontMatter;
}

function escapeTwigSyntax($text) {
    return preg_replace('/({?{[{%]|{?[}%]})/s', '{% raw %}$1{% endraw %}', $text);
}

function replaceLinks(string $text, array $permalinkToFilepathMap) {
    $pattern = '/(?<=]\()https:\/\/documentation\.spryker\.com\/v\d+\/.*?(?=\))/';

    return preg_replace_callback($pattern, function ($matches) use ($permalinkToFilepathMap) {
        $fullUrl = $matches[0];
        $filePath = $permalinkToFilepathMap[$fullUrl] ?? '';

        if (!$filePath) {
            return $fullUrl;
        }

        return '/docs/' . preg_replace(['/(?<=\/)v\d+(?=\/)/', '/\.md$/'], ['{{ page.version }}', ''], $filePath);

    }, $text);
}

function replaceSpecialBlocks(string $text) {
    $replaceCallback = function ($matches) {
        $type = strtolower($matches[1]) . 'Box';
        $header = $matches[2];
        $content = $matches[3];
        $infoBlockTemplate = <<<EOT
{%% info_block %s %s%%}
%s
{%% endinfo_block %%}
EOT;

        return sprintf(
            $infoBlockTemplate,
            $type,
            !empty($header) ? sprintf('"%s" ', $header) : '',
            $content
        );
    };

    return preg_replace_callback_array([
        '/@\((Info|Warning|Error)\)\((.*?)\)\((.*?)\)/s' => $replaceCallback,
        '/:::\((Info|Warning|Error)\) ?\((.*?)\)(.*?):::/s' => $replaceCallback,
    ], $text);
}

function buildDestinationPathname(SplFileInfo $fileInfo) {
    return DEST_DIR . '/' . transformPathname($fileInfo);
}

function transformPathname(SplFileInfo $fileInfo) {
    $fileName = $fileInfo->getFilename();
    $path = $fileInfo->getPath();
    $fileName = transformFileName($fileName);
    $path = transformPath($path);

    return sprintf('%s/%s', $path, $fileName);
}

function transformPath(string $path) {
    $versionsMap = require './versions_map.php';
    $path = trim($path, '/');
    $pathFragments = explode('/', $path);
    array_shift($pathFragments);
    $pathFragments = array_map(function ($pathFragment) {
        return normilize($pathFragment);
    }, $pathFragments);

    [$doc360Version, $rootCategory] = $pathFragments;
    $transformedVersion = $versionsMap[$doc360Version] ?? '';
    $pathFragments = array_merge([$rootCategory, $transformedVersion], array_slice($pathFragments, 2));

    return 'scos/dev/' . implode('/', $pathFragments);
}

function transformFileName(string $fileName) {
    $fileName = preg_replace('/\d+_/', '', $fileName);
    
    return normilize($fileName);
}

function normilize(string $str, string $delimiter = '-')
{
    return strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-.]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
}

function transformContents(string $contents, array $permalinkToFilepathMap) {
    [$meta, $text] = $metaEnd = explode('## Metadata_End', $contents);
    $frontMatter = buildFrontmatter($meta);
    $text = transformText($text, $permalinkToFilepathMap);

    return $frontMatter . $text;
}

function transformText(?string $text, array $permalinkToFilepathMap) {
    if ($text === null) {
        return '';
    }

    $text = escapeTwigSyntax($text);
    $text = replaceLinks($text, $permalinkToFilepathMap);
    $text = replaceSpecialBlocks($text);

    return $text;
}

function saveFile(string $contents, string $destPathname) {
    $dirname = dirname($destPathname);
    if (!is_dir($dirname)) {
        mkdir($dirname, 0777, true);
    }

    file_put_contents($destPathname, $contents);
}

$permalinkToFilepathMap = [];
/** @var \SplFileInfo $fileInfo */
foreach (loadFiles(SRC_DIR) as $fileInfo) {
    preg_match('/original-url : (.*)/m', file_get_contents($fileInfo->getPathname()), $matches);
    $originalUrl = trim($matches[1]);
    $permalinkToFilepathMap[$originalUrl] =  transformPathname($fileInfo);
}

/** @var \SplFileInfo $fileInfo */
foreach (loadFiles(SRC_DIR) as $fileInfo) {
    $contents = file_get_contents($fileInfo->getPathname());
    $contents = transformContents($contents, $permalinkToFilepathMap);
    $destPathname = buildDestinationPathname($fileInfo);

    saveFile($contents, $destPathname);
}
