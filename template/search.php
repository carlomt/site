<?php

function find_word_infile($to_be_found, $dirname, $filename)
{
    $contents = strip_tags(file_get_contents($dirname."/".$filename));
    $words = preg_split('/[\s]+/', $contents, -1, PREG_SPLIT_NO_EMPTY);
    foreach($words as $wordNumber => $word)
        {
            if(stripos($word, $to_be_found) !== false)
                {
                    $nWordToBeReturned = 12;
                    $selectedWordNumber = $wordNumber - $nWordToBeReturned / 2;
                    if($selectedWordNumber < 0) $selectedWordNumber = 0;
                    return array_slice($words, $selectedWordNumber, $nWordToBeReturned);
                }
        }
    return NULL;
}

function list_all_files_indir($dirname)
{
    $config = parse_ini_file('config.ini');
    $disallowed_paths = $config['disable_pages'];
    $results = array();
    $dir = new DirectoryIterator($dirname);
    foreach($dir as $fileinfo)
        if(!$fileinfo->isDot())
            {
                $filename = $fileinfo->getFilename();
                if((strpos($filename, '~') === false) &&
                   (strpos($filename, '#') === false) &&
                   (!in_array($filename, $disallowed_paths)))
                    {
                        if($fileinfo->isDir())
                            {
                                $tmp = list_all_files_indir($dirname."/".$filename);
                                foreach($tmp as &$value)
                                    {
                                        $value = $filename."/".$value;
                                    }
                                $results = array_merge($results, $tmp);
                            }
                        else
                            {
                                $results[] = $filename;
                            }
                    }
            }
    return $results;
}

function find_word_indir($input, $dir)
{
    $results = array();
    $allfiles = list_all_files_indir($dir);
    foreach($allfiles as $file)
        {
            $founds = find_word_infile($input, $dir, $file);
            if($founds)
                {
                    $results[] = array_merge(array($file), $founds);
                }
        }
    return $results;
}
