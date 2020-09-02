
<div class="container">
    <div class="row mt-2">
        <div class="col-md-12">
            <?php  if (isset($_SESSION['response'])):
                    foreach ($_SESSION['response']['message'] as $message):?>
                        <div class="alert alert-<?=$_SESSION['response']['type']?>" role="alert"><?=$message?></div>
            <?php endforeach; unset($_SESSION['response']); endif;?>

            <?php if (isset($_GET['action']) and $_GET['action']==='edit'):?>
            <form method="post" action="<?= APP_URL.'index.php?controller=user&action=update'?>" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?=$currentUser->id?>">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name"  value="<?=$currentUser->name?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" value="<?=$currentUser->email?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="passwordConfirmation">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="passwordConfirmation">password Confirmation</label>
                        <input type="password"  name="passwordConfirmation" class="form-control" id="passwordConfirmation" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="extra">Extra</label>
                    <input type="text" name="extra" class="form-control" id="extra" value="<?=$currentUser->extra?>">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputState">Room</label>
                        <select id="inputState" name="room_id" class="form-control">
                            <?php foreach ($rooms as $id=>$name):?>
                                <option value="<?=$id?>" <?php if ($currentUser->room_id==$id) echo 'selected'?>><?=$name?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputZip">Avatar</label>
                        <div class="custom-file mb-3">
                            <input type="file" class="custom-file-input" id="validatedCustomFile" name="avatar">
                            <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
            <?php  else:?>
            <form method="post" action="<?= APP_URL.'index.php?controller=user&action=store'?>" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name"  value="<?php old('name')?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" value="<?php old('email')?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" value="<?php old('password')?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="passwordConfirmation">password Confirmation</label>
                        <input type="password"  name="passwordConfirmation" class="form-control" id="passwordConfirmation" value="<?php old('passwordConfirmation')?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="extra">Extra</label>
                    <input type="text" name="extra" class="form-control" id="extra" value="<?php old('extra')?>">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputState">Room</label>
                        <select id="inputState" name="room_id" class="form-control">
                            <?php foreach ($rooms as $id=>$name):?>
                            <option value="<?=$id?>"><?=$name?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputZip">Avatar</label>
                        <div class="custom-file mb-3">
                            <input type="file" class="custom-file-input" id="validatedCustomFile" name="avatar">
                            <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
            <?php  endif; ?>



        </div>
        <div class="col-md-12 mt-2">
            <h3>Total Users Is (<?=count($users)?>)</h3>
            <table class="table table-bordered">
                <tr>
                    <th style="width: 10px">ID</th>
                    <th>Name</th>
                    <th> Email</th>
                    <th>Room</th>
                    <th>Avatar</th>
                    <th>Actions </th>
                </tr>
                <?php if (count($users)===0):?>
                    <tr><td colspan="6" class="text-center">No Users Exists</td></tr>
                <?php  endif; ?>

                <?php foreach ($users as $user):?>
                    <tr>
                        <td><?=$user->id?></td>
                        <td><?=$user->name?></td>
                        <td><?=$user->email?></td>
                        <td><?=$rooms[$user->room_id]?></td>
                        <td>
                            <?php if ($user->avatar===AVATAR):?>
                                <img src="<?=APP_URL.AVATAR?>" width="40px" height="40px">
                            <?php else:?>
                                <img src="<?=APP_URL.UPLOAD_DIR.'\\'.$user->avatar?>" class="rounded-circle" width="40px" height="40px">
                            <?php endif;?>

                        </td>
                        <td>
                            <form method="post" id="remove_form_<?=$user->id?>" action="<?= APP_URL.'index.php?controller=user&action=destroy'?>">
                                <input type="hidden" name="id" value="<?=$user->id?>">
                            </form>
                            <button class="btn btn-sm btn-danger" onclick="document.getElementById('remove_form_<?=$user->id?>').submit()">
                                Remove </button>
                            <a href="<?= APP_URL.'index.php?controller=user&action=edit&id='.$user->id?>" class="btn btn-sm btn-success"> Edit</a>
                        </td>

                    </tr>
                <?php endforeach;?>


            </table>
        </div>

    </div>
</div>