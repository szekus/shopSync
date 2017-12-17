<?php $shopRenterDataModel = $this->getModel() ?>

<div class="container">
    <a href="?action=logout" > <button  style="position: absolute;right: 20%;top:5%;"type="button" class="btn btn-primary">Kilépés</button></a>    
    <h1>Fő beállítások</h1>
    <h3>Shoprenter Adatok</h3>
    <form action="?action=settings " method="POST">

        <div class="form-group">
            <label><b>ShopRenter felhasználói név</b></label>
            <input type="text" class="form-control" placeholder="" name="userName" required value="<?php echo $shopRenterDataModel->getUserName(); ?>">
        </div>
        <div class="form-group">
            <label><b>Shoprenter API kulcs</b></label>
            <input type="text" class="form-control" placeholder="" name="apiKey" required value="<?php echo $shopRenterDataModel->getApiKey(); ?>">
        </div>
        <div class="form-group">
            <label><b>Shoprenter API url</b></label>
            <input type="text" class="form-control" placeholder="" name="apiUrl" required value="<?php echo $shopRenterDataModel->getApiUrl(); ?>">
        </div>
        <div class="form-group">
            Termék feed url: <a href="<?php echo config\Config::create()->getRoot() . '/products.xml' ?>" target="_blank" download="products.xml">
                <?php echo config\Config::create()->getRoot() . 'products.xml' ?>
            </a>
        </div>

        <button type="submit" class="btn btn-primary">Mentés</button>
        <a href="?action=generateXML" > <button  style="margin-left: 10%;"type="button" class="btn btn-primary">Generate</button></a>


    </form>
</div>

