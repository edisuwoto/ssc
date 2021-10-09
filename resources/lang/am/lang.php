<?php
                                                    $jsonFile =  base_path() ."/resources/lang/am/am.json";
                                                    $array =  json_decode(file_get_contents($jsonFile), true);
                                                    return $array;