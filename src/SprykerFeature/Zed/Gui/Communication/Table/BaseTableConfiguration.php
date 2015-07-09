<?php
/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace SprykerFeature\Zed\Gui\Communication\Table;

class BaseTableConfiguration {

    /**
     * @var array
     */
    private $headers;

    /**
     * @var array
     */
    private $sortable;

    /**
     * @param array $headers
     */
    public function setHeaders(array $headers){
        if ($this->isAssoc($headers) === true){
            $this->headers = $headers;
        }
    }

    /**
     * @return array
     */
    public function getHeaders(){
        return $this->headers;
    }

    /**
     * @return array
     */
    public function getSortable(){
        return $this->sortable;
    }

    /**
     * @param array $sortable
     */
    public function setSortable(array $sortable){
        $this->sortable = array_intersect(
            $sortable,
            array_keys($this->headers)
        );
    }

    /**
     * @param array $array
     *
     * @return bool
     */
    function isAssoc(array $array)
    {
        return array_keys($array) !== range(0, count($array) - 1);
    }


}