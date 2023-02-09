<?php
$title = "Procede al Pago de tus Entradas";
include "includes/header.php";
if (isset($_POST["article0"]))
{
    $size = count($_POST);
    for ($i = 0; $i < $size / 2; $i++)
    {
        $event[$i] = $_POST["article" . $i];
        $event_data[$i] = explode("-", $event[$i]);
        $qtty[$i] = $_POST["qtty" . $i];
        $event_size = count($event);
        $total = 0;
    }
?>
<style>
    body{background: #f5f5f5}.rounded{border-radius: 1rem}.nav-pills .nav-link{color: #555}.nav-pills .nav-link.active{color: white}input[type="radio"]{margin-right: 5px}.bold{font-weight:bold}
</style>
<div class="container">
        <div class="row">
        <div id="page_top">
            <div class="col-12 mt-4">
                <div class="card p-3">
                    <p class="mb-0 fw-bold h4">Métodos de Pago</p>
                </div>
            </div>
            <div class="col-12">
                <div class="card p-3">
                    <div class="card-body border p-0">
                        <p>
                            <a class="btn btn-primary w-100 h-100 d-flex align-items-center justify-content-between"
                                data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="true"
                                aria-controls="collapseExample">
                                <span class="fw-bold">PayPal y Tatjetas</span>
                                <span class="fab fa-cc-paypal">
                                </span>
                            </a>
                        </p>
                        <div class="collapse show p-3 pt-0" id="collapseExample">
                            <div class="row">
                                <div class="col-8">
                                    <p class="h4 mb-0">Detalles</p>
                                    <?php
                                    for ($i = 0; $i < $event_size; $i++)
                                    {
                                        echo '<p class="mb-0"><span class="fw-bold">Entradas: </span><span class="c-green">' . $event_data[$i][1] . '</span></p>
                                        <p class="mb-0"><span class="fw-bold">Precio: </span><span class="c-green">' . $event_data[$i][2] . '</span></p>
                                        <p class="mb-0"><span class="fw-bold">Cantidad: </span><span class="c-green">' . $qtty[$i] . '</span></p>
                                        <p class="mb-0"><span class="fw-bold">Total a pagar: </span><span class="c-green">' . $event_data[$i][2] * $qtty[$i] . '</span></p>
                                        <br>';
                                        $total += $event_data[$i][2] * $qtty[$i];
                                    }
                                    ?>
                                    <div id="paypal-button"></div>

<script src="https://www.paypalobjects.com/api/checkout.js"></script>

<script>

  paypal.Button.render({

    // Configure environment

    env: 'sandbox',

    client: {

      sandbox: 'demo_sandbox_client_id',

      production: 'demo_production_client_id'

    },

    // Customize button (optional)

    locale: 'es_ES',

    style: {
        size: 'small', color: 'gold', shape: 'pill',
    },


    // Enable Pay Now checkout flow (optional)

    commit: true,


    // Set up a payment

    payment: function(data, actions) {
        var btn = document.getElementById('getQR');
        btn.style.visibility = "visible";

      return actions.payment.create({

        transactions: [{

            amount: {
                  total: '<?php echo $total; ?>', currency: 'EUR'
            }
        }]
      });
    },

    // Execute the payment

    onAuthorize: function(data, actions) {

      return actions.payment.execute().then(function() {

        // Show a confirmation message to the buyer

        window.alert('Gracias por tu Compra!');

      });

    }

  }, '#paypal-button');

</script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form action="checkout.php" method="post">
                <?php
                for ($i = 0; $i < $event_size; $i++)
                {
                    echo '<input type="hidden" name="id' . $i . '" value="' . $event_data[$i][0] . '">
                    <input type="hidden" name="event' . $i . '" value="' . $event_data[$i][1] . '">
                    <input type="hidden" name="price' . $i . '" value="' . $event_data[$i][2] . '">
                    <input type="hidden" name="qtty' . $i . '" value="' . $qtty[$i] . '">';
                }
                ?>
                <input class="btn btn-primary" type="submit" id="getQR" style="visibility: hidden;" value="Dame Mis Entradas">
            </form>
        </div>
        </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="js/script2.js"></script>
<script>screenSize()</script>
<?php
}
else
{
    echo "<script>alert ('Has Llegado Aquí por Error.');</script>";
}
include "includes/footer.html";
?>
</body>
</html>