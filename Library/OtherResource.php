<?php
namespace Library;

class OtherResource extends LibraryResource
{

    private $res_name;
    private $res_description;
    private $res_brand;

    public function __construct(string $resourceCategory)
    {
        parent::__construct($resourceCategory);
    }

    /**
     * Add the resource to the JSON file
     * @param string $res_name
     * @param string $res_description
     * @param string $res_brand
     */
    public function addOtherResource(string $res_name, string $res_description, string $res_brand)
    {
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
    public function saveResource()
    {
        parent::saveResourceInJSON('other_resources', $this->getOtherResourceItem());
    }

}
