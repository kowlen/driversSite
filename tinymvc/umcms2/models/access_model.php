<?php
class Access_Model extends TinyMVC_Model
{
    function get_modx($user){
        //default
        $modx[] = array("mod" => "single", "modname" => na_main_menu_single,
            "items" => array(
                ["url"=>"access_single", "name"=>na_main_menu_single_enter],
            ));
        //reports
        $modx[] = array("mod" => "reports", "modname" => na_main_menu_reports,
            "items" => array(
                ["url"=>"consolidate2", "name"=>main_menu_report_consolidated],
                ["url"=>"donotexec", "name"=>main_menu_report_precept],
                ["url"=>"analisys_not_detect", "name"=>main_menu_report_not_detect],
                ["url"=>"analisys_gpk", "name"=>main_menu_report_analisys_gpk],
                ["url"=>"analisys_safety_division", "name"=>main_menu_report_analisys_safety_division],
                ["url"=>"category", "name"=>main_menu_report_category],
                ["url"=>"repeated", "name"=>main_menu_report_repeated],
                ["url"=>"level_control", "name"=>main_menu_report_level_pc],
                ["url"=>"dailyreport", "name"=>main_menu_report_dailyreport],
               // ["url"=>"timesheet", "name"=>main_menu_report_table_exit]
            ));
        //admin
        $modx[] = array("mod" => "admin", "modname" => na_main_menu_admin,
            "items" => array(
                ["url"=>"access_admin", "name"=>na_main_menu_admin_enter],

            ));
        //help
        $modx[] = array("mod" => "help", "modname" => admin_main_menu_help,
            "items" => array(
                ["tags"=>"data-toggle=\"modal\" data-target=\"#modal-1\"", "name"=>admin_main_menu_help_help],
                ["url"=>"tutorials", "name"=>admin_main_menu_help_instr]

            ));
        $modx[] = array("mod" => "help", "modname" => na_main_menu_faq,
            "items" => array(
                ["url"=>"history_change", "name"=>admin_main_menu_history_change]

            ));
        return $modx;
    }

}
?>