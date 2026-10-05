<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style type="text/css">
      * {
        font-size: 10px !important;
      }
      @page{
         margin: 0;
      }
      table.border td, table.border th, table.border tr, table.border {
        border-top: 1px solid black;
        border-collapse: collapse;
        border: 1px dotted #aaa;
        border-left: none;
        border-right: none;
      }

      td.description, th.description {
        width: 75px;
        font-size: 10px;
        max-width: 75px;
      }
      td.description{
        font-size: 8px;
      }

      td.quantity, th.quantity {
        width: 20px;
        max-width: 40px;
        font-size: 10px;
        word-break: break-all;
      }
      td.quantity{
        font-size: 8px;
      }

      td.price, th.price {
        width: 60px;
        max-width: 40px;
        font-size: 10px;
        word-break: break-all;
      }
      td.price{
        font-size: 8px;
      }


      .centered {
          text-align: center;
          align-content: center;
      }

      .ticket {
          width: 160px;
          max-width: 160px;
      }

      .text-small{
        font-size: 7px; 
      }


      @media print {
          .hidden-print,
          .hidden-print * {
              display: none !important;
          }
      }
    </style>
    <link rel="stylesheet" href="<?= base_url('assets') ?>/vendor/bootstrap/css/bootstrap-theme.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/vendor/font-awesome/css/font-awesome.min.css">
    <title>Cetak Struk</title>
  </head>
  <body>
    <div class="ticket">
      <h4 class="text-left" style="font-weight: bold; font-size: 12px !important;"><i class="fa fa-shopping-cart" style="font-size: 25px !important;"></i> <?= $setting->nama_apotek ?></h4>
      <p class="text-left text-small" style="margin-top: -10px;">&nbsp; <?= $setting->alamat ?></p>
      <!-- <p class="text-left text-small" style="margin-top: -10px;">&nbsp; <?= $setting->alamat ?></p> -->

      ------------------------------------------------
     

      <table style="border:  1px solid none; width: 100%" >
        <tr>
          <th style="font-size: 10px !important">No. Trx</th>
          <th  style="font-size: 10px !important">&nbsp; : &nbsp;</th>
          <td  style="font-size: 10px !important"><?= $penjualan->id ?></td>
        </tr>
        <tr>
          <th style="font-size: 10px !important">Tanggal</th>
          <th  style="font-size: 10px !important">&nbsp; : &nbsp;</th>
          <td  style="font-size: 10px !important"><?= date('d/m/Y', strtotime($penjualan->tanggal_jam)) . ' ' . date('H:i', strtotime($penjualan->tanggal_jam)) ?></td>
        </tr>
        <tr>
          <th style="font-size: 10px !important">Customer</th>
          <th  style="font-size: 10px !important">&nbsp; : &nbsp;</th>
          <td  style="font-size: 10px !important"><?= $penjualan->nama_pembeli ?></td>
        </tr>
        

      </table>




       <table width="100%">
        <tr>
          <td class="text-center">------------------------------------------------<br><br></td>
        </tr>
        <?php $total = 0;
        $potongan = 0;
        foreach ($penjualan_detail as $key) : ?>
          <tr>
            <td style="font-size: 9px !important;">
              <?= ucfirst($key->nama_item) ?>   <small class="pull-right">/ <?= strtolower($key->satuan) ?></small>  
              <div class="row">
                <div class="col-xs-6 text-left text-small">&nbsp; <?= $key->kuantiti ?> &nbsp; x &nbsp; <?= number_format($key->harga - $key->diskon, 0, ',', '.') ?></div>
                <div class="col-xs-6 text-right text-small"><?= number_format($key->total, 0, ',', '.') ?></div>
              </p>
              <hr style="margin-top: -2px;">
            </td>
          </tr>
        <?php $total += $key->total;
        endforeach ?> 
        <tr>
          <td class="text-center">============================</td>
        </tr>
        <tr>
          <td class="description">
            <div class="row">
              <div class="col-xs-6 text-left text-small">TOTAL </div>
              <div class="col-xs-6 text-right text-small"><?= number_format($total, 0, ',', '.') ?></div>
            </div>
          </td>
        </tr>
        <tr>
          <td class="description">
            <div class="row">
              <div class="col-xs-6 text-left text-small"><?= strtoupper($penjualan_pembayaran->cara_bayar) ?></div>
              <div class="col-xs-6 text-right text-small"><?= number_format($penjualan_pembayaran->nominal, 0, ',', '.') ?></div>
            </div>
          </td>
        </tr>
        <tr>
          <td class="text-center">============================</td>
        </tr>
        <tr>
          <td class="description">
            <div class="row">
              <div class="col-xs-6 text-left text-small">KEMBALI</div>
              <div class="col-xs-6 text-right text-small">Rp. <?= number_format($penjualan_pembayaran->nominal - $total, 0, ',', '.') ?></div>
            </div>
          </td>
        </tr>
        <tr>
          <td class="text-center">============================</td>
        </tr>
      </table>

      <p class="text-small text-center">
        <br>
        <br>
        <small><?= $setting->footer_struk ?> <i class="fa fa-smile-o"></i></small>
        <br><br><br>
        <small style="color: #ddd">.</small>
      </p>
  </body>

<script>
  
  window.print();
  setTimeout(function(){
    close();
  }, 2000);
// </script>
</html>
