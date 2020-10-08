<?php
    
    /**
     * Get search results 
     * 
     * @access public
     * @author Johan Borg
     * @global $conn
     * @param no params
     * @return object Query
     */
    function search_pictures() {
        global $conn;
        if (isset($_GET['search_site'])) {
            $search_value = mysqli_real_escape_string($conn, $_GET['search_input']);
            $search_query = "SELECT *, pictures.id AS pid FROM pictures JOIN users ON pictures.user_id = users.id WHERE title LIKE '%$search_value%' OR thumbnail_description LIKE '%$search_value%' OR pic_description LIKE '%$search_value%'";
            $result = mysqli_query($conn, $search_query);

            return $result;
        }
    }

    /**
     * Get the Search Query Name
     * 
     * Use this function to echo out the query name on the search page
     * 
     * @access public
     * @author Johan Borg
     * @return string
     */
    function get_search_name() {
        $get_name = $_GET['search_input'];
        return $get_name;
    }
    
// EOF
    