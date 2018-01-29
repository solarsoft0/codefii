<a href="/new-framework">Return</a>
<?php foreach($datas as $data){

?>

<h2><?php echo $data->title; ?></h2>
    <h6><?php echo $data->body; ?></h6>
    <h6><?php echo $data->created; ?></h6>

<?php } ?>