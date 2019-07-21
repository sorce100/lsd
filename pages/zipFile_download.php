<?php 
$folderName= trim($_GET["folderName"]);
$folderName= trim($folderName);
$folderName=htmlentities(trim($folderName),ENT_QUOTES, 'UTF-8');
$folderName = filter_var($folderName,FILTER_SANITIZE_SPECIAL_CHARS);

$rootPath = "../uploads/new_applications/";
$zipname=$folderName.'.zip';
$zip = new ZipArchive();
$zip->open($zipname, ZipArchive::CREATE | ZipArchive::OVERWRITE);
// Create recursive directory iterator
/** @var SplFileInfo[] $files */
$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootPath),
    RecursiveIteratorIterator::LEAVES_ONLY
);
foreach ($files as $name => $file)
{
    // Skip directories (they would be added automatically)
    if (!$file->isDir())
    {
        // Get real and relative path for current file
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($rootPath) + 1);

        // Add current file to archive
        $zip->addFile($filePath, $relativePath);
    }
}
// Zip archive will be created only after closing object
$zip->close();
header("content-type:application/octect-stream");
header("content-disposition:attachment; folderName=$zipname");
// Read the file to download
readfile($zipname);
// delete file after it has being downloaded and return to tha calling page
unlink($zipname);

 ?>