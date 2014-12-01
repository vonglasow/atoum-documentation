<?php
    $languages = array('fr', 'en');

    $skrivDirectory = __DIR__;
    $rtdDirectory   = __DIR__ . '/rtd';

    foreach ($languages as $language) {
        foreach (glob($skrivDirectory . '/' . $language . '/*.skriv') as $skrivFile) {
            $content = file_get_contents($skrivFile);

            # TITLES
            $replaceTitle = function($content, $prefix, $sign) {
                $content = preg_replace_callback(
                    "/^$prefix([^=].*)$prefix([^=].*)\$/m",
                    function($matches) use($sign) {
                        return
                            '.. _' . camelCaseToDashCase($matches[2]) . ":\n\n" .
                            $matches[1] . "\n" .
                            str_repeat($sign, strlen(iconv('UTF-8', 'ASCII//TRANSLIT', $matches[1])))
                        ;
                    },
                    $content
                );

                $content = preg_replace_callback(
                    "/^$prefix([^=].*)\$/m",
                    function($matches) use($sign) {
                        $ascii = iconv('UTF-8', 'ASCII//TRANSLIT', $matches[1]);

                        return
                            '.. _' . camelCaseToDashCase(
                                trim(
                                    preg_replace(
                                        '/[^a-zA-Z0-9]/',
                                        '-',
                                        $ascii
                                    ),
                                    '-'
                                )
                            ) . ":\n\n" .
                            $matches[1] . "\n" .
                            str_repeat($sign, strlen($ascii))
                        ;
                    },
                    $content
                );

                return $content;
            };

            $content = $replaceTitle($content, '=', '=');
            $content = $replaceTitle($content, '==', '-');
            $content = $replaceTitle($content, '===', '~');
            $content = $replaceTitle($content, '====', '^');
            $content = $replaceTitle($content, '=====', '`');

            # LINKS
            $content = preg_replace_callback(
                '/\[\[(.*)\|#(.*)\]\]/U',
                function($matches) {
                    return ':ref:`' . $matches[1] . ' <' . camelCaseToDashCase($matches[2]) . '>`';
                },
                $content
            );
            $content = preg_replace('/\[\[(.*)\|(.*)\]\]/U', '`$1 <$2>`_', $content);

            # LISTS
            $content = preg_replace('/\n([^\*].*)\n\*/m', "\$1\n\n*", $content);

            # ACRONYMS
            $content = preg_replace('/\?\?(.*)\|(.*)\?\?/U', '$1 ($2)', $content);

            # QUOTES
            $content = preg_replace("/>(.*)\n>\n>##(.*)##/", ".. epigraph::\n\n   $1\n\n   -- $2", $content);
            $content = str_replace("\\#", '#', $content);

            # CODES
            $content = preg_replace('/##(:ref:`.*`)##/U', '$1', $content);
            $content = preg_replace('/##[\\\\]*([^\\\\].*)##/U', '``$1``', $content);
            $content = preg_replace_callback(
                '/\[\[\[(.*)\n(.*)\n\]\]\]/sU',
                function($matches) {
                    $matches[2] = explode("\n", $matches[2]);

                    foreach (array_keys($matches[2]) as $line) {
                        $matches[2][$line] = '   ' . $matches[2][$line];
                    }

                    $matches[2] = implode("\n", $matches[2]);

                    return
                        '.. code-block:: ' . $matches[1] . "\n\n" .
                        $matches[2]
                    ;
                },
                $content
            );

            # INFOS
            $replaceNotes = function($content, $from, $to) {
                $content = preg_replace_callback(
                    "/\{\{\{$from\n(.*)\n\}\}\}/sU",
                    function($matches) use($to) {
                        $matches[1] = explode("\n", $matches[1]);

                        foreach (array_keys($matches[1]) as $line) {
                            $matches[1][$line] = '   ' . $matches[1][$line];
                        }

                        $matches[1] = implode("\n", $matches[1]);

                        return
                            ".. $to::" . "\n" .
                            $matches[1] . "\n"
                        ;
                    },
                    $content
                );

                return $content;
            };

            $content = $replaceNotes($content, 'info', 'note');
            $content = $replaceNotes($content, 'warning', 'warning');
            $content = $replaceNotes($content, 'todo', 'important');
            $content = $replaceNotes($content, 'inheritance', 'hint');

            $filename = basename($skrivFile, '.skriv');
            file_put_contents($rtdDirectory . '/' . $language . '/source/' . $filename . '.rst', $content);
        }
    }


    # FUNCTIONS
    function camelCaseToDashCase($string) {
        $string = preg_replace('/(?<=\\w)(?=[A-Z])/', '-$1', $string);
        $string = strtolower($string);

        if (strpos($string, '-') === false) {
            $string .= '-anchor';
        }

        return $string;
    }
