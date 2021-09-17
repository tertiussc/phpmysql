<?php
/**
 * Paginator
 * 
 * Used to select a page of records
 */
class Paginator
{
    /**
     * @var integer $limit Number of records to display
     */
    public $limit;

    /**
     * @var integer $offset Number of records to skip
     */
    public $offset;

    /**
     * @var integer $previous for the previous page
     */
    public $previous;

    /**
     * @var integer $next for the next page
     */
    public $next;

    /**
     * Constructor
     * 
     * @param integer $page Page number
     * @param integer $records_per_page Number of records per page
     * 
     * @return void
     */
    public function __construct($page, $records_per_page, $total_records)
    {
        $this->limit = $records_per_page;

        // Check to see if $page is an integer and if not assign a default
        $page = filter_var($page, FILTER_VALIDATE_INT, [
            'options' => [
                'default' => 1,
                'min_range' => 1
            ]
        ]);

        // Prevent pages from going less then 1
        if ($page > 1 ) {
            $this->previous = $page - 1;
        }

        // calculate the total number of pages
        $total_pages = ceil($total_records / $records_per_page);
        // only set next property if current page is smaller then the total number of pages
        if ($page < $total_pages) {
            $this->next = $page + 1;
        }

        
        $this->offset = $records_per_page * ($page - 1);
    }
}
