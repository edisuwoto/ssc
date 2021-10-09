<?php
                                                    $jsonFile =  base_path() ."/resources/lang/bg/bg.json";
                                                    $array =  json_decode(file_get_contents($jsonFile), true);
                                                    return $array;