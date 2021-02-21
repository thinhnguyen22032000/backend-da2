<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/customer.php';?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Profile</h2>
              
               <div class="block copyblock"> 
                 <form action="catadd.php" method="post">
                    <table class="form">
                        <?php 
                                if(isset($_GET['ctid']) && $_GET['ctid'] != NULL){
                                    $id = $_GET['ctid'];
                                }
                                else{
                                    echo "<script>window.location = 'inbox.php'</script>";
                                }
                                $ct = new customer();
                                $get_ct_id = $ct->get_ct_by_id($id);
                                if($get_ct_id){
                                    while($result = $get_ct_id->fetch_assoc()){ ?>
                          

                           <tr>  
                                <td>Tên</td>
                                <td>:</td>
                                <td>
                                    <input type="text" readonly="readonly" value="<?php echo $result['name'] ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td>:</td>
                                <td>
                                   <input type="text" readonly="readonly" value="<?php echo $result['phone'] ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>Thành phố</td>
                                <td>:</td>
                                <td>
                                   <input type="text" readonly="readonly" value="<?php echo $result['city'] ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                 <td>Quốc gia</td>
                                <td>:</td>
                                <td>
                                    <input type="text" readonly="readonly" value="<?php echo $result['country'] ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                 <td>Địa chỉ</td>
                                <td>:</td>
                                <td>
                                   <input type="text" readonly="readonly" value="<?php echo $result['address'] ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                 <td>Zipcode</td>
                                <td>:</td>
                                <td>
                                   <input type="text" readonly="readonly" value="<?php echo $result['zipcode'] ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                 <td>Mail</td>
                                <td>:</td>
                                <td>
                                    <input type="text" readonly="readonly" value="<?php echo $result['email'] ?>" class="medium" />
                                </td>
                            </tr>
						 <?php
                                    }
                                }
                        ?>
                            
                       
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>