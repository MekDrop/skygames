<?php 


class LgslComponent extends Object {
   var $cache;

   function __construct() {
      $this->cache = CACHE . 'rss' . DS; 
   }

   function get_server($get_ip, $get_port, $get_type) {

     // Include the vendor class
     
     require_once('vendors'.DS.'lgsl'.DS.'lgsl_protocol.php');
     
     $start = microtime(true);
     	 
     list($qport, $cport, $sport) = lgsl_port_conversion($get_port, false, false, $get_type);
     
     $tmp = lgsl_query_live($get_ip, $qport, $cport, $sport, $get_type, "s");
     $end = microtime(true);			
	 $tmp['s']['query_time'] = round(($end - $start)*1000);      
     
     return $tmp;
   }
   
	function get_players($get_ip, $get_port, $get_type) {


     // Include the vendor class
           
	 require_once('vendors'.DS.'lgsl'.DS.'lgsl_protocol.php');
      
     list($qport, $cport, $sport) = lgsl_port_conversion($get_port, false, false, $get_type);
     
     $tmp = lgsl_query_live($get_ip, $qport, $cport, $sport, $get_type, "p");
      
     return $tmp;
   }
}
?>