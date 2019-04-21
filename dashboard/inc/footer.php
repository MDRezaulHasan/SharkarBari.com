		
            <div style="clear: both;"></div>
        </div>
        <!-- /#wrap -->
        <!--||||||||||||||||||||||||||||||||-->
        <!--******FOOTER SECTION START******-->
        <footer class="Footer bg-dark dker">
            <p>&copy; 2017 <a href="../index.php" target="_blank" title="Bid War Bd">Sharkar Bari</a>, All Rights Reserved.</p>
        </footer>
        <!--******FOOTER SECTION START END******-->


        <!--***********REQUIRED JS SCRIPT START**************-->   
        <!--jQuery -->
        <script src="../assets/js/jquery.js"></script>
        <!--Bootstrap -->
        <script src="assets/js/moment.js"></script>
        <script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>
        <!--Bootstrap DataTable SCRIPT-->
        <script type="text/javascript" src="../assets/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="../assets/js/dataTables.bootstrap.min.js"></script>
        <script type="text/javascript" src="../assets/js/dataTables.responsive.min.js"></script>
        <script type="text/javascript" src="../assets/js/responsive.bootstrap.min.js"></script>
        
        <script>
        $(document).ready(function() {
            $('#example').DataTable();
            
            $("#example #checkall").click(function () {
                if ($("#example #checkall").is(':checked')) {
                    $("#example input[type=checkbox]").each(function () {
                        $(this).prop("checked", true);
                    });

                } else {
                    $("#example input[type=checkbox]").each(function () {
                        $(this).prop("checked", false);
                    });
                }
            });
            
            $('#example2').DataTable();
            
            $("#example2 #checkall").click(function () {
                if ($("#example2 #checkall").is(':checked')) {
                    $("#example2 input[type=checkbox]").each(function () {
                        $(this).prop("checked", true);
                    });

                } else {
                    $("#example2 input[type=checkbox]").each(function () {
                        $(this).prop("checked", false);
                    });
                }
            });

            $("[data-toggle=tooltip]").tooltip();
        } );
        </script>
        

        <!--metisMenu Js -->
        <script src="assets/js/metisMenu.js" type="text/javascript"></script>
        <script src="assets/js/core.js" type="text/javascript"></script>
        <script>
            $(function() {
              Metis.dashboard();
            });
        </script>
        
        
        <!--***********REQUIRED JS SCRIPT END**************-->
    </body>
</html>
