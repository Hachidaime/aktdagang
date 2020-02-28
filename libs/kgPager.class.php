<?php

class kgPager {
    var $total_records = NULL;
    var $start = NULL;
    var $scroll_page = NULL;
    var $per_page = NULL;
    var $total_pages = NULL;
    var $current_page = NULL;
    var $page_links = NULL;

    // total pages and essential variables
    function total_pages ($pager_url, $total_records, $scroll_page, $per_page, $current_page) {
        $this -> url = $pager_url;
        $this -> total_records = $total_records;
        $this -> scroll_page = $scroll_page;
        $this -> per_page = $per_page;
        if (!is_numeric($current_page)) {
            $this -> current_page = 1;
        }else{
            $this -> current_page = $current_page;
        }
        if ($this -> current_page == 1) $this -> start = 0; else $this -> start = ($this -> current_page - 1) * $this -> per_page;
        $this -> total_pages = ceil($this -> total_records / $this -> per_page);
    }

    // page links
    function page_links ($inactive_page_tag, $pager_url_last) {
        if ($this -> total_pages <= $this -> scroll_page) {
            if ($this -> total_records <= $this -> per_page) {
                $loop_start = 1;
                $loop_finish = $this -> total_pages;
            }else{
                $loop_start = 1;
                $loop_finish = $this -> total_pages;
            }
        }else{
            if($this -> current_page < intval($this -> scroll_page / 2) + 1) {
                $loop_start = 1;
                $loop_finish = $this -> scroll_page;
            }else{
                $loop_start = $this -> current_page - intval($this -> scroll_page / 2);
                $loop_finish = $this -> current_page + intval($this -> scroll_page / 2);
                if ($loop_finish > $this -> total_pages) $loop_finish = $this -> total_pages;
            }
        }
        for ($i = $loop_start; $i <= $loop_finish; $i++) {
            if ($i == $this -> current_page) {
                $this -> page_links .= '<a class="w3-button" '.$inactive_page_tag.'>'.$i.'</a>';
            }else{
                $this -> page_links .= '<a href="'.$this -> url.$i.$pager_url_last.'" class="w3-button">'.$i.'</a>';
            }
        }
    }

    // previous page
    function previous_page ($previous_page_text, $pager_url_last) {
        if ($this -> current_page > 1) {
            $this -> previous_page = '<a href="'.$this -> url.($this -> current_page - 1).$pager_url_last.'" class="w3-button">'.$previous_page_text.'</a>';
        }
				else
				{
					$this -> previous_page = "";
				}
    }

    // next page
    function next_page ($next_page_text, $pager_url_last) {
        if ($this -> current_page < $this -> total_pages) {
            $this -> next_page = '<a href="'.$this -> url.($this -> current_page + 1).$pager_url_last.'" class="w3-button">'.$next_page_text.'</a>';
        }
				else
				{
					$this -> next_page = "";
				}
    }

    // first page
    function first_page ($first_page_text, $pager_url_last) {
        if ($this -> current_page > 1) {
            $this -> first_page = '<a href="'.$this -> url.'1'.$pager_url_last.'" class="w3-button">'.$first_page_text.'</a>'; // :)
        }
				else
				{
					$this -> first_page = "";
				}
    }

    // last page
    function last_page ($last_page_text, $pager_url_last) {
        if ($this -> current_page < $this -> total_pages) {
            $this -> last_page = '<a href="'.$this -> url.$this -> total_pages.$pager_url_last.'" class="w3-button">'.$last_page_text.'</a>';
        }
				else
				{
					$this -> last_page = "";
				}
    }

    // pages functions set
    function pager_set ($pager_url, $total_records, $scroll_page, $per_page, $current_page, $inactive_page_tag, $previous_page_text, $next_page_text, $first_page_text, $last_page_text, $pager_url_last) {
        $this -> total_pages($pager_url, $total_records, $scroll_page, $per_page, $current_page);
        $this -> page_links($inactive_page_tag, $pager_url_last);
        $this -> previous_page($previous_page_text, $pager_url_last);
        $this -> next_page($next_page_text, $pager_url_last);
        $this -> first_page($first_page_text, $pager_url_last);
        $this -> last_page($last_page_text, $pager_url_last);
    }
}
 
?>