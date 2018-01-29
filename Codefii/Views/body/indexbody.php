
<h1>Welcome to my blog</h1>
<?php foreach($user as $use)
{
?>
<a href="/new-framework/user/<?= $use->id; ?>"><?=$use->username; ?></a>
<?php foreach($posts as $post){


?>
<li><a href="view/<?php echo $post->id; ?>">
<?php echo $post->title;?></a>  ::<a href="update/<?php echo $post->id;?>">Update</a>::<a href="comment/<?php echo $post->id;?>">reply</a>
<?php if($use->role =="Worker"){
?>


<?php  }elseif($use->role =="Admin"){ ?>

    ::<a href="delete/<?php echo $post->id;?>">Delete</a>

<?php } ?>
    <br /><ol>
        <h4>Comment</h4>
        <?php foreach($comments as $comment){
            if($comment->blogid == $post->id){
        ?>
     <li><b><?php echo $comment->comment; ?></b></li>
        <?php }}?>
    </ol>
</li>

<?php  }?>

<?php
}?>
<br />
