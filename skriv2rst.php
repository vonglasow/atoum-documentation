<?php
    $languages = array('fr', 'en');

    $skrivDirectory = __DIR__;
    $rtdDirectory   = __DIR__ . '/rtd';

    foreach ($languages as $language) {
        foreach (glob($skrivDirectory . '/' . $language . '/*.skriv') as $skrivFile) {
            $content = file_get_contents($skrivFile);

            # TITLES
            $replaceTitle = function($content, $prefix, $sign) {
                return preg_replace_callback(
                    "/^$prefix([^=].*)\$/m",
                    function($matches) use($sign) {
                        $ascii = strtolower(iconv('UTF-8', 'ASCII//TRANSLIT', $matches[1]));

                        return
                            '.. _' . trim(
                                preg_replace(
                                    '/[^a-zA-Z0-9]/',
                                    '-',
                                    $ascii
                                ),
                                '-'
                            ) . ":\n\n" .
                            $matches[1] . "\n" .
                            str_repeat($sign, strlen($ascii))
                        ;
                    },
                    $content
                );
            };

            $content = $replaceTitle($content, '=', '=');
            $content = $replaceTitle($content, '==', '-');
            $content = $replaceTitle($content, '===', '~');
            $content = $replaceTitle($content, '====', '^');

            # LINKS
            $content = preg_replace_callback(
                '/\[\[(.*)\|#(.*)\]\]/U',
                function($matches) {
                    return ':ref:`' . $matches[1] . ' <' . strtolower($matches[2]) . '>`';
                },
                $content
            );
            $content = preg_replace('/\[\[(.*)\|(.*)\]\]/U', '`$1 <$2>`_', $content);

            # LISTS
            $content = preg_replace('/\n([^\*].*)\n\*/m', "\$1\n\n*", $content);

            # ACRONYMS
            $content = preg_replace('/\?\?(.*)\|(.*)\?\?/U', '$1 ($2)', $content);

            # CODES
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
            $content = preg_replace_callback(
                '/\{\{\{(.*)\n(.*)\n\}\}\}/',
                function($matches) {
                    $matches[2] = explode("\n", $matches[2]);

                    foreach (array_keys($matches[2]) as $line) {
                        $matches[2][$line] = '   ' . $matches[2][$line];
                    }

                    $matches[2] = implode("\n", $matches[2]);

                    return
                        '.. note::' . "\n" .
                        $matches[2]
                    ;
                },
                $content
            );

            $filename = basename($skrivFile, '.skriv');
            file_put_contents($rtdDirectory . '/' . $language . '/source/' . $filename . '.rst', $content);
        }
    }
