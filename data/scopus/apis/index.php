<?php
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$url_citedby = $_POST['url_citedby'];
$url_author = $_POST['url_author'];
$document_count = $_POST['document_count'];
$affiliation_current = $_POST['affiliation_current'];

echo 'Author = ' . $firstname . ' ' . $lastname . '<hr>';
echo 'Affiliation = ' . $affiliation_current . '<hr>';
echo $url_citedby; ?><a href=<?php echo $url_citedby; ?>> Click link </a>
<hr>
<?php
echo $url_author
?><a href=<?php echo $url_author; ?>> Click link </a>
<hr>
<?php echo 'Documents by author = ' . $document_count . '<hr>'; ?>
<a href="index.php">back</a>