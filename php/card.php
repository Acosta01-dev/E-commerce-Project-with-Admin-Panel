<div class="producto-card">
    <div>

    </div>

    <div class="producto-card_imagen">
        <img src="<?php echo $row["image"] ?>">
    </div>

    <div class="producto-card_imagen-etiquetas">
        <div>
            <h3 class="producto-card_titulo"><?php echo $row["title"] ?></h3>
            <i><i class="uil uil-tag-alt"></i> <?php echo $row["category"] ?></i>
        </div>

        <p class="producto-card_price"><i class="uil uil-usd-circle"></i>&nbsp;<?php echo $row["price"] ?></p>
    </div>

    <div class="producto-card_botones">
        <button>Buy Now </button>
    </div>

</div>