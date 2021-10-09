<?php
                                                    $jsonFile =  base_path() ."/resources/lang/zu/zu.json";
                                                    $array =  json_decode(file_get_contents($jsonFile), true);
                                                    return $array;