<?php 
/**
 * you can start to write here your function.
 */
function breadcrumb($name){
    echo  ' <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="'.BASE_URL.'">Home</a> </li>
                    <li class="breadcrumb-item active">'.$name.'</li>
                </ol>
            </nav>';      
}

?>