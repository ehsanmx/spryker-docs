<?php

require_once 'vendor/autoload.php';

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

function normilize(string $str, string $delimiter = '-')
{
    return strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-.]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
}

function getTitle(SplFileInfo $fileInfo) {
    $contents = file_get_contents($fileInfo->getPathname());
    preg_match('/title: (.*)/m', $contents, $matches);

    return trim($matches[1]);
}

function buildUrl(SplFileInfo $fileInfo, array $categories) {
    return sprintf(
        '/docs/scos/dev/%s/%s',
        implode('/', $categories),
        $fileInfo->getBasename('.' . $fileInfo->getExtension())
    );
}

function getCategories(SplFileInfo $fileInfo) {
    $categoriesString = substr($fileInfo->getPath(), 14);
    $categoriesStringWithoutVersion = preg_replace('/\/\d+\.\d+/', '', $categoriesString);

    return explode('/', $categoriesStringWithoutVersion);
}

function getVersion(SplFileInfo $fileInfo) {
    preg_match('/\/(\d+\.\d+)/', $fileInfo->getPath(), $matches);

    return $matches[1] ?? null;
}

function addEntry(SplFileInfo $fileInfo, array &$result, array $categoryTitleMap) {
    $title = getTitle($fileInfo);
    $categories = getCategories($fileInfo);
    $url = buildUrl($fileInfo, $categories);
    $version = getVersion($fileInfo);
    $pageResult = &$result;

    foreach ($categories as $key => $category) {
        // build categories hierarchy
        $categoryTitle = $categoryTitleMap[$category];

        if (!isset($pageResult[$categoryTitle])) {
            $pageResult[$categoryTitle] = [];
        }

        $pageResult = &$pageResult[$categoryTitle];

        if ($key !== array_key_last($categories)) {
            continue;
        }

        // add page data
        if (!isset($pageResult[$title])) {
            $pageResult[$title] = [];
        }

        if (!isset($pageResult[$title]['url'])) {
            $pageResult[$title]['url'] = $url;
        }

        $includeVersions = $pageResult[$title]['include_versions'] ?? [];
        array_push($includeVersions, $version);
        $includeVersions = array_unique($includeVersions);
        sort($includeVersions);

        // page is present in all versions
        if (count($includeVersions) === 6) {
            unset($pageResult[$title]['include_versions']);

            continue;
        }

        $pageResult[$title]['include_versions'] = $includeVersions;
    }
}

function generateSidebarData($entries) {
    $result = [];

    if (!$entries) {
        return $result;
    }

    foreach ($entries as $key => $value) {
        $entryData = [
            'title' => $key
        ];

        // check if value is leaf or not
        if (!isset($value['url'])) {
            $entryData['nested'] = generateSidebarData($value);
        } else {
            $entryData['url'] = $value['url'] . '.html';

            if (isset($value['include_versions'])) {
                $entryData['include_versions'] = $value['include_versions'];
            }
        }

        $result[] = $entryData;
    }

    return $result;
}

$entries = [];
$categoryTitleMap = [];

// Build category to category title map
/** @var \SplFileInfo $fileInfo */
foreach (loadFiles(SRC_DIR) as $fileInfo) {
    $path = $fileInfo->getPath();
    $pathWithoutVersion = preg_replace('/\/v\d+/', '', $path);
    $categoryTitles = explode('/', $pathWithoutVersion);
    $normalizedCategoryTitles = array_map(function ($categoryTitle) {
        return normilize($categoryTitle);
    }, $categoryTitles);

    $categoryTitleMap += array_combine($normalizedCategoryTitles, $categoryTitles);
}

/** @var \SplFileInfo $fileInfo */
foreach (loadFiles(DEST_DIR) as $fileInfo) {
    addEntry($fileInfo, $entries, $categoryTitleMap);
}

$sidebarArray = [
    'title' => 'SCOS Developer Guides',
    'entries' => [
        'product' => 'SCOS',
        'nested' => generateSidebarData($entries)
    ]
];

$yaml = \Symfony\Component\Yaml\Yaml::dump($sidebarArray);
file_put_contents('sidebar.yml', $yaml);
