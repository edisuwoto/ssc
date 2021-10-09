<?php
                                                    $jsonFile =  base_path() ."/resources/lang/af/af.json";
                                                    $array =  json_decode(file_get_contents($jsonFile), true);
                                                    return $array;