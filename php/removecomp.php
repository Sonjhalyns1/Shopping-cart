<?php
// removecomp.php

function removecomp($product_name, $product_price, $product_image, $product_original, $product_description, $product_id)
{
    $element = "
    <div class=\"row justify-content-center\">
        <div class=\"col-md-3 col-sm-6 my-3 my-md-0\">
            <form action=\"cart.php\" method=\"POST\" class=\"cart-items\">
                <input type=\"hidden\" name=\"remove\" value=\"$product_id\">
                <div class=\"card shadow\">
                    <div>
                        <img src=\"$product_image\" alt=\"$product_name\" class=\"img-fluid card-img-top\">
                    </div>
                    <div class=\"card-body\">
                        <h5 class=\"card-title\">$product_name</h5>
                        <h6 class=\"card-subtitle mb-2 text-muted\">$product_description</h6>
                        <h6>
                            <span class=\"text-secondary\">Original Price: </span>
                            <s>$$product_original</s>
                        </h6>
                        <h6 class=\"card-text\">Price: $$product_price</h6>
                        <button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"submit\">Remove</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    ";
    echo $element;
}
?>

