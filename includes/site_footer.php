<?php
/*
#######################################################
Product Name : TTMS
Product Version: 1.0
Developer: Saransh Kalia
Web: www.99degreesnorth.com
Email: conteact@99degreesnorth.com
#######################################################
*/
?>
    </div>
    <div class="well well-sm">
        <?php
        if(isset($_SESSION['user'])) {
            $software_info=$_SESSION['user'];
        }
        else{
            $software_info = "";
        }

        ?>
           <p align="center" class="text-muted"><b>The copy of this product is registered to: <font color="red"><em> <?php echo $software_info; ?></em></font></b></p>
    </div>
        <p> &nbsp;</p>
        <div id="footer">
          <div align="center" class="container">
            <p class="text-muted credit">&copy 2014 TTMS, Traffic Ticket Management Version :1.0 is a product of <a href="http://www.99degreesnorth.com">Ninety Nine Degrees North</a>.</p>
            <p class="text-muted credit">Developed & Maintained by Saransh Kalia. Made in <font color="red"> Canada !</font></p>

          </div>
        </div>

</body>

</html>