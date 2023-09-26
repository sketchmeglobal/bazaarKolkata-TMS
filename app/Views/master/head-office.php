<?= view('component/header') ?>
<!-- < ?= isset($validation) ? print_r($validation) : ''; die; ?> -->
<style>
#s_myFormName .error {
    color: red !important;
    position: relative;
    padding: 0;
}
</style>
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- SIDE-NAV-START -->
        <?= view('component/side_nav') ?>
        <!-- SIDE-NAV-END -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?= view('component/top_nav') ?>
            <!-- Navbar End -->
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-6 col-10 bg-light py-2 text-center border-bottom-all-rd">
                        <h5 class="text-primary">Head Office</h5>
                    </div>
                </div>
            </div>
            <div></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 px-4">
                        <button type="button" id="addNewRecord" class="btn btn-primary ms-2"
                            style="float: right; margin-bottom: 5px;">Add New</button>

                        <table id="myTable" class="display">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Head Office Name</th>
                                    <th>Head Office Location</th>
                                    <th>Acction</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($head) : ?>
                                <?php foreach ($head as $office) : ?>
                                <tr>
                                    <td><?= $office['id'] ?> </td>
                                    <td><?= $office['name'] ?></td>
                                    <td><?= $office['location'] ?></td>
                                    <td class="d-flex justify-content-evenly">
                                        <a href="#" class="edit_class" data-table_id="1"><i class="fa fa-edit"></i></a>
                                        <a class="remove" href="#"><i class="fas fa-times"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                                <?php endif ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal start -->
            <div id="myModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="text-primary modal-title" id="exampleModalLongTitle"> Head office
                            </h5>

                            <button type="button" class=" btn btn-lg btn-primary btn-lg-square back-to-topclose"
                                data-dismiss="modal" aria-label="Close" id="closeModal1"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" id="s_myFormName" method="post">
                                <div class="form-row">
                                    <?php
                                    if (!empty(session()->getFlashdata('success'))) { ?>
                                    <div class="alert alert-success">
                                        <?php echo session()->getFlashdata('success'); ?>
                                    </div>
                                    <?php } ?>
                                    <div class="col-md-11 col-12 mb-2">
                                        <label for="headofficeName">Head office Name</label>
                                        <input type="text" class="form-control" name="name" id="headofficeName" required
                                            value="<?= isset($name) ? $name : '' ?>">
                                        <span class="error">
                                            <?=(isset($validation['name']) ? $validation['name'] : '' ); ?>
                                        </span>


                                    </div>
                                    <div class="col-md-11 col-12 mb-2">
                                        <label for="headofficeLocation">Head office Location</label>
                                        <input minlength="5" type="text" class="form-control" name="address"
                                            id="headofficeLocation" required
                                            value="<?= isset($address) ? $address : '' ?>">
                                        <span
                                            class="error"><?= (isset($validation['address']) ? $validation['address'] : ''); ?></span>
                                    </div>

                                    <div class="col-md-4 ">
                                        <label for="s_parentDesignation">&nbsp;</label>
                                        <input class="btn btn-primary py-2 w-100 mb-1" type="submit" value="Save"
                                            name="submit">
                                    </div>
                                </div>
                                <input type="hidden" id="table_id" name="table_id" value="">
                            </form>

                        </div>
                        <!-- <div class="modal-footer">
                            <div id="formValidMsg" class="invalid-feedback"> </div>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                id="closeModal">Close</button>
                        </div> -->
                    </div>
                </div>
            </div>
            <!-- Modal end -->

            <!-- Footer Start -->
            <?= view('component/footer') ?>
            <!-- Footer End -->
            <!-- JavaScript Libraries -->

            <?= view('component/js') ?>
            <script>
            $("#s_myFormName").validate();

            $(".remove").click(function() {
                $(this).closest('tr').remove();
            });

            //Show Modal
            $('#addNewRecord').on('click', function() {
                $("#s_myFormName").trigger("reset");
                $('#myModal').modal('show');
            })
            $('#closeModal1, #closeModal').on('click', function() {
                $('#myModal').modal('hide');
            })
            </script>