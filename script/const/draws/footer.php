<footer id="footer" class="footer">


  <div class="footer-info text-center">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="footer-info-content">
            <div class="footer-logo">
              <img class="img-fluid" src="images/logos/<?php echo WBLogoInverse; ?>" alt="" />
            </div>
            <p><?php echo WBAddress; ?></p>
            <p class="footer-info-phone"><i class="feather icon-phone-call"></i> <?php echo WBPhone; ?></p>
            <p class="footer-info-email"><i class="feather icon-mail"></i> <?php echo WBEmail; ?></p>
            <a href="https://ayman-sys.github.io/ayman.codes"><p>Designed By Ayman Shaikh</p></a>
            <ul class="unstyled footer-social">
              <li>
                <?php

                try {
                $conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $conn->prepare("SELECT * FROM tbl_social_links ORDER BY id LIMIT 10");
                $stmt->execute();
                $result = $stmt->fetchAll();

                foreach($result as $row)
                {
                  if ($row[2] == "#") {
                    ?>
                    <a title="<?php echo $row[1]; ?>" href="javascript:void(0);">
                      <span class="social-icon"><i class="<?php echo $row[3]; ?>"></i></span>
                    </a>
                    <?php
                  }else{
                    ?>
                    <a title="<?php echo $row[1]; ?>" href="<?php echo $row[2]; ?>">
                      <span class="social-icon"><i class="<?php echo $row[3]; ?>"></i></span>
                    </a>
                    <?php
                  }

                }
                }catch(PDOException $e)
                {
                echo "Connection failed: " . $e->getMessage();
                }
                ?>

              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

</footer>
