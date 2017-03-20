<?php if(isset($_SESSION['auth_error'])): ?>
    <ul class="list-group">
        <li class="list-group-item list-group-item-danger">
            <?= $_SESSION['auth_error'] ?>
        </li>
    </ul>
<?php endif;?>


<div class="row login-form">
    <div class="col-md-12">
        <form class="form-horizontal" method="POST">
            <fieldset>
                <legend><h1><small>Вхід на сайт</small></h1></legend>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Логін:</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="login" placeholder="e-mail" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="pwd">Пароль:</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="pwd" name="password" placeholder="пароль" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary btn-md">Увійти</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>