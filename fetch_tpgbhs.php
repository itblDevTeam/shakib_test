<?PHP

set_time_limit(300);
 include 'Connection.php';
 //$P_BILL_CYCLE_CODE = $_GET['P_BILL_CYCLE_CODE'];
 //$P_ZONE_CODE = $_GET['P_ZONE_CODE'];


 $TP_STR_KEY_WORD = 'STD_NAME';
 $TP_EDIT_KEY_WORD = 'sumon';
 
 // execute query starts
 $curs = oci_new_cursor($conn);

 $stid = oci_parse($conn, "begin APPS_SELECTED_DATA.APPS_GET_STUDENT_DTL(:cur_data,:strKeyWord,:edtKeyword); end;");


 oci_bind_by_name($stid, ":cur_data", $curs, -1, OCI_B_CURSOR);
 oci_bind_by_name($stid, ":strKeyWord", $TP_STR_KEY_WORD, -1, SQLT_CHR);
 oci_bind_by_name($stid, ":edtKeyword", $TP_EDIT_KEY_WORD, -1, SQLT_CHR);

 oci_execute($stid);
 oci_execute($curs);
               // execute query ends
               
               // store fetch data in variable array starts 
 while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
   $output[] = $row;
 }
 // store fetch data in variable array ends
print json_encode($output);

oci_free_statement($stid);
oci_free_statement($curs);
oci_close($conn);



?>