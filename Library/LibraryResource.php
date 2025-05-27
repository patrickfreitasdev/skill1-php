<?php

/**
 * Class LibraryResource
 * @package Library
 *
 * This is a blueprint for all resources in the library including books, magazines, etc.
 *
 */

namespace Library;

class LibraryResource
{

    protected string $resourceCategory;
    protected string $resourceId;
    private array $fileItems;

    public function __construct($resourceCategory)
    {
        $this->resourceCategory = $resourceCategory;
        $this->resourceId       = $this->generateUniqueId();

        // preload the file items
        $this->fileItems = $this->getFileContentByFileName($this->resourceCategory);
    }

    /**
     * Generate a unique ID for the resource, using the uniqid function from PHP
     * @return string
     */
    protected function generateUniqueId(): string
    {
        return \uniqid();
    }

    /**
     * Save the resource in a JSON file, it is expected to be called from the child class
     * @param string $fileName
     * @param array $resourceData
     * @return void
     */
    protected function saveResourceInJSON(string $fileName, array $resourceData): void
    {

        $orderedData = [
            'resourceId'       => $this->resourceId,
            'resourceCategory' => $this->resourceCategory,
            ...$resourceData,
        ];

        if (file_exists('storage' . \DIRECTORY_SEPARATOR  . $fileName . '.json')) {
            $existingData = file_get_contents('storage' . \DIRECTORY_SEPARATOR  . $fileName . '.json');
            $existingData = json_decode($existingData, true);

            if (is_array($existingData)) {
                // Make sure unique ID is generated because the PHP uniqid function may not be 100% unique
                foreach ($existingData as $key => $value) {
                    if ($value['resourceId'] === $orderedData['resourceId']) {
                        $orderedData['resourceId'] = $this->generateUniqueId();
                    }
                }
            } else {
                $existingData = [];
            }

        } else {
            $existingData = [];
        }

        $existingData[] = $orderedData;

        $jsonData = json_encode($existingData);

        file_put_contents('storage' . \DIRECTORY_SEPARATOR  . $fileName . '.json', $jsonData);

        echo "Item saved";
    }

    /**
     * Get the content of the file by the file name, it will be easier to return the content to the book and Other Resources
     * Note, the return depends on file, it is not supposed to be a formatted return, consult readme for more information
     * @param string $fileName
     * @return array
     */
    protected function getFileContentByFileName(string $fileName): array
    {

        if (file_exists('storage' . \DIRECTORY_SEPARATOR  . $fileName . '.json')) {

            $fileContent = file_get_contents('storage' . \DIRECTORY_SEPARATOR  . $fileName . '.json');
            $fileContent = json_decode($fileContent, true);

            if (is_array($fileContent)) {
                return $fileContent;
            } else {
                return [];
            }

        } else {
            return [];
        }
    }

    /**
     * We need to locate the resource key, it could be a book or other resources, so to not repeat the code better to have in the blueprint
     * @param string $id
     * @return int|false
     */
    protected function locateKeyById(string $id): int | false
    {
        $fileContent = $this->fileItems;
        $key         = array_search($id, array_column($fileContent, 'resourceId'));
        return $key;
    }

    /**
     * We remove the resource by the ID, since the other resource and books use the "resourceId"
     * @param string $id
     * @param string $filename
     * @return void
     */
    public function deleteResourceById(string $id, string $filename): void
    {

        $items = $this->fileItems;
        $key   = $this->locateKeyById($id);

        if ($key !== false) {
            unset($items[$key]);

            $jsonData = json_encode($items);
            file_put_contents('storage' . \DIRECTORY_SEPARATOR  . $filename . '.json', $jsonData);

            echo "Item deleted";
        } else {
            echo "Item not found";
        }

    }

    /**
     * Get the file items
     * @return array
     */
    protected function getFileItems(): array
    {
        return $this->fileItems ?? [];
    }

    /**
     * Count the number of items in the file
     * @param string $fileName
     * @return int
     */
    public function countResourceItems(string $fileName = 'other_resources'): int
    {
        return count($this->getFileContentByFileName($fileName));
    }
}
