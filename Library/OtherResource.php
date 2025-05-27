<?php

/**
 * Class OtherResource
 * @package Library
 *
 * This is the OtherResource class for the library system
 *
 */

namespace Library;

class OtherResource extends LibraryResource
{

    private string $res_name;
    private string $res_description;
    private string $res_brand;

    public function __construct($res_name = '', $res_description = '', $res_brand = '', $resourceCategory = 'other_resources')
    {
        parent::__construct($resourceCategory);
        $this->res_name        = $res_name;
        $this->res_description = $res_description;
        $this->res_brand       = $res_brand;
    }

    /**
     * Get the resource item
     * @return array
     */
    public function getOtherResourceItem(): array
    {
        return [
            'resourceId'       => $this->resourceId,
            'resourceCategory' => $this->resourceCategory,
            'res_name'         => $this->res_name,
            'res_description'  => $this->res_description,
            'res_brand'        => $this->res_brand,
        ];
    }

    /**
     * Save the resource to the JSON file
     */
    public function saveOtherResource(): void
    {
        parent::saveResourceInJSON('other_resources', $this->getOtherResourceItem());
    }

    /**
     * Get the resource by the id and print out the resource details
     * @param string $id
     * @return void
     */
    public function getResourceById(string $id): void
    {

        $otherResources = parent::getFileItems();

        if (empty($otherResources)) {
            echo "No other resources found";
            return;
        }

        $key = parent::locateKeyById($id);

        // Array search retruns the index,
        // so we need to validate the type too otherwise index 0 would be considered a false in PHP
        if ($key !== false) {
            echo "\n----------------------------------------\n";
            echo "Resource ID: " . $otherResources[$key]['resourceId'] . "\n";
            echo "Resource Category: " . $otherResources[$key]['resourceCategory'] . "\n";
            echo "Resource Name: " . $otherResources[$key]['res_name'] . "\n";
            echo "Resource Description: " . $otherResources[$key]['res_description'] . "\n";
            echo "Resource Brand: " . $otherResources[$key]['res_brand'] . "\n";
            echo "\n----------------------------------------\n";
        } else {
            echo "\n----------------------------------------\n";
            echo "Resource not found";
            echo "\n----------------------------------------\n";
        }
    }

    /**
     * List all the resources from the JSON file
     */
    public function listOtherResources($otherResources = []): void
    {
        if (empty($otherResources)) {
            $otherResources = parent::getFileItems();
        }

        if (empty($otherResources)) {
            echo "No other resources found";
            return;
        }

        foreach ($otherResources as $otherResource) {
            echo "\n----------------------------------------\n";
            echo "Resource ID: " . $otherResource['resourceId'] . "\n";
            echo "Resource Category: " . $otherResource['resourceCategory'] . "\n";
            echo "Resource Name: " . $otherResource['res_name'] . "\n";
            echo "Resource Description: " . $otherResource['res_description'] . "\n";
            echo "Resource Brand: " . $otherResource['res_brand'] . "\n";
            echo "----------------------------------------\n";
        }
    }

}
