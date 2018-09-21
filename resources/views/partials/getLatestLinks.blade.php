<?php
$latestSql = "select * from `links` ORDER BY `posted` DESC";
$latestRes = $conn->query($latestSql);
while ($latestRow = $latestRes->fetch_assoc()) {


    ?>
    <div class="link-item">
        <div class="link-thumb">
            <img class="img-responsive" src="http://www.mnra.gov.bz/wp-content/plugins/special-recent-posts/images/no-thumb.png">
        </div>
        <div class="link-content">
            <h4 class="link-title"><a href="view.php?id=<?= $latestRow['id'] ?>&title=<?= str_replace(" ", "-", $latestRow['title']) ?>"
                                      target="_blank"><?=$latestRow['title'] ?></a></h4>
            <p class="link-desc"><?= substr($latestRow['desc'],0, 120); ?></p>
            <p>Posted <strong><?= $latestRow['posted'] ?></strong></p>
        </div>
    </div>
    <?php
}
?>