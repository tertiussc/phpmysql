<?php
/**
 * Add pagination for the page
 */

// get base uri
$basePath = strtok($_SERVER["REQUEST_URI"], '?');


?>

<nav aria-label="Page navigation">
    <ul class="pagination">
        <!-- Previous pagination link -->
        <?php if ($paginator->previous) : ?>
            <li class="page-item"><a class="page-link" href="<?= $basePath . "?page=" . $paginator->previous; ?>">Prev</a></li>
            <?php else : ?>
                <li class="page-item disabled"><a class="page-link" href="<?= $basePath . "?page=" . $paginator->previous; ?>">Prev</a></li>
        <?php endif; ?>

        <!-- Page link in between -->
        <?php for ($i = 0; $i < (Article::getTotal($conn, true) / $paginator->limit); $i++) : ?>
            <li class="page-item <?= ($currentPage == ($i + 1)) ? 'active' : ''; ?>"><a class="page-link" href="?page=<?= $i + 1 ?>"><?php echo $i + 1; ?></a></li>
        <?php endfor; ?>

        <!-- Next Pagination link -->
        <?php if ($paginator->next) : ?>
            <li class="page-item"><a class="page-link" href="<?= $basePath . "?page=" . $paginator->next; ?>">Next</a></li>
        <?php else : ?>
            <li class="page-item disabled"><a class="page-link" href="<?= $basePath . "?page=" . $paginator->next; ?>">Next</a></li>
        <?php endif; ?>
    </ul>
</nav>