<main>
    <div class="breadcrumb_pc">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="<?php echo base_url() ?>">Trang chủ</a></li>
                        <?php foreach ($Breadcrumb as $key => $val) { ?>
                            <?php
                            $title = $val['title'];
                            $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'articles_catalogues');
                            ?>
                            <li><a href="<?php echo $href; ?>"><?php echo $title; ?></a></li><?php } ?>
                    </ul>

                </div>

            </div>

        </div>

    </div>
    <div class="clearfix-20"></div>

    <section id="chitietnhathuoc">


        <div class="container">
            <div class="row">
                <div class="col-md-9 col-xs-12 col-sm-8">
                    <h1><?php echo $DetailCatalogues['title'] ?></h1>

                    <div class="clearfix-20"></div>


                    <?php if (is_array($listcat) && isset($listcat) && count($listcat)) { ?>
                        <?php foreach ($listcat as $key => $value) { ?>


                            <div class="table-responsive">
                                <h2><?php echo $value['title'] ?></h2>
                                <?php if (is_array($value['post']) && isset($value['post']) && count($value['post'])) { ?>
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">

                                        <?php
                                        echo "<tr>";
                                        foreach ($value['post'] as $keyP => $valP) {

                                            $title = $valP['title'];
                                            $href = rewrite_url($valP['canonical'], $valP['slug'], $valP['id'], 'articles');

                                            if ($keyP == 4) {
                                                echo "</tr>";
                                                echo "<tr>";
                                            }
                                            echo "<td>";
                                            echo '<a href="' . $href . '">'.$title.'</a>';
                                            echo "</td>";
                                        }
                                        echo "</tr>";
                                        ?>

                                    </table>

                                <?php } ?>
                            </div>
                        <?php }
                    } ?>


                    <div class="clearfix"></div>
                    <div class="et_pb_text_inner">


                        <p>Nếu bạn không tìm được nhà thuốc thuận tiện, vui lòng gọi hotline (miễn
                                cước)&nbsp;<a href="tel:<?php echo $this->fcSystem['contact_phone']?>"><?php echo $this->fcSystem['contact_phone']?></a> để
                                được hướng dẫn mua thuốc.</p>

                        <p>Quý khách cũng có thể đặt hàng online&nbsp;<a
                                    href="dat-mua-online.html">TẠI ĐÂY</a>&nbsp;để được giao hàng
                                tận nhà.</p>


                    </div>


                </div>
                <?php $this->load->view('homepage/frontend/common/aside'); ?>

            </div>


        </div>

    </section>
</main>