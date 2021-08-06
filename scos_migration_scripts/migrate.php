<?php

define('SRC_DIR', 'src');
define('DEST_DIR', 'dest');

$versionsMap = [
    'v1' => '201811.0',
    'v2' => '201903.0',
    'v3' => '201907.0',
    'v4' => '202001.0',
    'v5' => '202005.0',
    'v6' => '202009.0',
    '2021080' => '202108.0',
];

$userCategories = [
    'user-guides',
    'intro-to-spryker',
];

$permalinkToFilepathMap = [];

/** @var \SplFileInfo $fileInfo */
foreach (loadFiles(SRC_DIR) as $fileInfo) {
    $contents = file_get_contents($fileInfo->getPathname());
    $fileName = getFileNameFromContents($contents);
    $originalUrl = getOriginalUrlFromContents($contents);
    $permalinkToFilepathMap[$originalUrl] = buildPathname($fileName, $fileInfo->getPath());
}

/** @var \SplFileInfo $fileInfo */
foreach (loadFiles(SRC_DIR) as $fileInfo) {
    $contents = file_get_contents($fileInfo->getPathname());
    $fileName = getFileNameFromContents($contents);
    $contents = transformContents($contents, $permalinkToFilepathMap);
    $destPathname = buildDestinationPathname($fileName, $fileInfo->getPath());

    saveFile($contents, $destPathname);
}

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

    $title = getTitleFromContents($meta);
    $originalUrl = getOriginalUrlFromContents($meta);

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

        return sprintf('/docs/%s.html', preg_replace(['/(?<=\/)v\d+(?=\/)/', '/\.md$/'], ['{{ page.version }}', ''], $filePath));

    }, $text);
}

function replaceSpecialBlocks(string $text) {
    $replaceCallback = function ($matches) {
        $type = strtolower($matches[1]) . 'Box';
        $header = $matches[2];
        $contents = $matches[3];
        $infoBlockTemplate = <<<EOT
{%% info_block %s %s%%}
%s
{%% endinfo_block %%}
EOT;

        return sprintf(
            $infoBlockTemplate,
            $type,
            !empty($header) ? sprintf('"%s" ', $header) : '',
            $contents
        );
    };

    return preg_replace_callback_array([
        '/@\((Info|Warning|Error)\)\((.*?)\)\((.*?)\)/s' => $replaceCallback,
        '/:::\((Info|Warning|Error)\) ?\((.*?)\)(.*?):::/s' => $replaceCallback,
    ], $text);
}

function buildDestinationPathname(string $fileName, string $path) {
    return sprintf('%s/%s', DEST_DIR, buildPathname($fileName, $path));
}

function buildPathname(string $fileName, $path) {
    $fileName = transformFileName($fileName);
    $path = transformPath($path);

    return sprintf('%s/%s', $path, $fileName);
}

function transformPath(string $path) {
    global $versionsMap;
    global $userCategories;

    $path = trim($path, '/');
    $pathFragments = explode('/', $path);
    array_shift($pathFragments);
    $pathFragments = array_map(function ($pathFragment) {
        return normalize($pathFragment);
    }, $pathFragments);

    [$doc360Version, $rootCategory] = $pathFragments;
    $transformedVersion = $versionsMap[$doc360Version] ?? '';
    $pathFragments = array_merge([$rootCategory, $transformedVersion], array_slice($pathFragments, 2));

    return sprintf(
        'scos/%s/%s',
        in_array($rootCategory, $userCategories) ? 'user' : 'dev',
        implode('/', $pathFragments)
    );
}

function transformFileName(string $fileName) {
    $fileName = preg_replace('/\d+_/', '', $fileName);

    return normalize($fileName);
}

function normalize(string $str, string $delimiter = '-')
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

function getFileNameFromContents(string $contents)
{
    $title = getTitleFromContents($contents);

    return normalize($title) . '.md';
}

function getOriginalUrlFromContents(string $contents) {
    preg_match('/original-url : (.*)/m', $contents, $matches);

    return trim($matches[1]);
}

function getTitleFromContents(string $contents) {
    preg_match('/title: (.*)/m', $contents, $matches);

    return trim($matches[1]);
}
