<?php

/**
 * Converte texto Markdown em json. Função criada primariamente por @ruturajhaval https://github.com/ruturajhaval/php-markdown-to-json-object/blob/master/markdown-parser.php
 * 
 * @param String md_route Rota para arquivo Markdown
 */
function md_to_json($md_route)
{

    $blogPostArray = array();

    try {
        $fp = fopen($md_route, "r");
    } catch (Exception $e) {
        echo 'File does not exist';
    }
    $hrTagCount = 0;
    $readmoreCount = 0;
    while ($contents = fgets($fp)) {
        // echo $contents;
        // echo substr($contents, 0, strpos($contents, ":"))."\n";
        $contents = trim($contents);
        if ($contents == '---') {
            $hrTagCount++;
            continue;
        } else {
            if ($hrTagCount < 2) {
                $arrKey = strval(substr($contents, 0, strpos($contents, ":")));
                $arrContent = filter_var(strval(str_replace('"', "", substr($contents, strpos($contents, ":")))));
            } else {
                if (strtolower($contents) == "readmore") {
                    $readmoreCount++;
                    continue;
                } elseif ($contents == "") {
                    continue;
                } else {
                    if ($readmoreCount >= 1) {
                        $arrKey = "content";
                        $contents = str_replace("#", "", $contents);
                        $contents = trim($contents);
                        if (array_key_exists("content", $blogPostArray)) {
                            $arrContent = $blogPostArray["content"] . "\n" . $contents;
                        } else {
                            $arrContent = $contents;
                        }
                    } else {
                        $arrKey = "short-content";
                        $arrContent = $contents;
                    }
                }
            }
            $blogPostArray[$arrKey] = $arrContent;
        }
    }

    fclose($fp);
    print_r(json_encode($blogPostArray));
    return json_encode($blogPostArray);
}
