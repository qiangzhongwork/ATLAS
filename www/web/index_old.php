<!DOCTYPE html>

<html>
	<head>
       
        <link type="text/css" rel="stylesheet" href="main.css"/>
        <title>ATLAS: Database of TCR-pMHC affinities and structures</title>	
	</head>
	<body>
        <?php require 'ATLAS_functions.php'; ?>
        <div id="header">
            <img class="logo" src="atlas_img.png"  />

        </div>
        <div class="nav">
            <ul>
                <li><a class="active" href="./">Home</a></li>
                <li><a  href="downloads.php">Downloads</a></li>
                <li><a  href="resources.html">Resources</a></li>
                <li><a  href="references.html">References</a></li>
                <li><a href="contact.html">Contact</a></li>
            </ul>
        </div>

        <div id="intro" >
            <h2> Welcome to the ATLAS Database </h2>
            <p> ATLAS (Altered TCR Ligand Affinities and Structures) is a database containing wild type and mutant binding affinities for all TCRs for which TCR-pMHC structures are available. It is available for training and evalutaing next generation TCR-pMHC scoring functions.</p>    
        </div>
        
        <form action="search_results.php" method="POST">
            <div class="search">
                <?php $link = database_connect(); ?>
                <h2> Search</h2><br><br>
               
                
                <!-- Select TCR -->
                <?php
                $query="SELECT * FROM TCRs";
                $result=mysqli_query($link, $query) or die(mysqli_error($link));
                $i = 0;
                while($row=mysqli_fetch_array($result)) {
                    $TCRnames[$i] = $row['TCRname'];
                    $i++;
                }
                ?>
                TCR: 
                <select name="TCR">
                    <option>all</option>
                    <?php
                        for($j=0;$j<count($TCRnames);$j++) {
                            ?>
                            <option>
                            <?php 
                            echo $TCRnames[$j];
                            ?>
                            </option>
                            <?php
                        }
                    ?>
                </select><br><br>
                
                
                
                <!-- Select TRAV -->
                <?php
                $query="SELECT TRAV from TCRs";
                $result=mysqli_query($link, $query) or die(mysqli_error());
                $i = 0;
                while($row=mysqli_fetch_array($result)) {
                    $TRAVnames[$i]= $row['TRAV'];
                    $i++;
                }
                $TRAVnames = array_values(array_unique($TRAVnames));
                ?>
                TRAV:
                <select name="TRAV">
                    <option>all</option>
                    <?php
                        for($j=0; $j<count($TRAVnames); $j++) {
                            ?>
                            <option>
                            <?php
                            echo $TRAVnames[$j];
                            ?>
                            </option>
                            <?php
                        }
                    ?>
                    </select><br><br>

                
                <!-- Select TRBV -->
                <?php
                $query="SELECT TRBV from TCRs";
                $result=mysqli_query($link, $query) or die(mysqli_error());
                $i = 0;
                while($row=mysqli_fetch_array($result)) {
                    $TRBVnames[$i]= $row['TRBV'];
                    $i++;
                }
                $TRBVnames = array_values(array_unique($TRBVnames));
                ?>
                TRBV:
                <select name="TRBV">
                    <option>all</option>
                    <?php
                        for($j=0; $j<count($TRBVnames); $j++) {
                            ?>
                            <option>
                            <?php
                            echo $TRBVnames[$j];
                            ?>
                            </option>
                            <?php
                        }
                    ?>
                </select><br><br>

                <!-- Select MHC class -->
                MHC class:
                <select name="MHCclass">
                    <option>all</option>
                    <option>I</option>
                    <option>II</option>
                </select><br><br>

                <!-- Select HLA allele -->
                <?php
                $query="SELECT MHCname from MHCs";
                $result=mysqli_query($link, $query) or die(mysqli_error());
                $i = 0;
                while($row=mysqli_fetch_array($result)) {
                    $MHCnames[$i]= $row['MHCname'];
                    $i++;
                }
                ?>
                MHC allele:
                <select name="MHCname">
                    <option>all</option>
                    <?php
                        for($j=0; $j<count($MHCnames); $j++) {
                            ?>
                            <option>
                            <?php
                            echo $MHCnames[$j];
                            ?>
                            </option>
                            <?php
                        }
                    ?>
                </select><br><br>

                <!--Select dG range -->
                &#916G <
                <input type="text" name="dG" value="0.00">
                </select><br><br>





                
            </div>
            <div class="display">
                <h2> Display</h2>
                <?php 
                $query = "SHOW COLUMNS FROM Mutants";
                $result=mysqli_query($link, $query) or die(mysqli_error($link));
                $i = 0;
                while($row=mysqli_fetch_array($result)) {
                    $display_opts[$i] = $row['Field'];
                    $i++;
                }
                ?>
                <ul class="checkbox-grid">
                    <li><input type="checkbox" name="disp_all" checked> all </li><br><br>
                    <?php
                    for ($j=0; $j<count($display_opts); $j++) {
                        ?>
                        <li><input type="checkbox" name="opts[]" value="<?php echo $display_opts[$j]; ?>">
                        <?php echo $display_opts[$j];?> </li>
                    <?php }
                    ?>
                </ul>
            </div>
            <br><br>
            <input type="submit" name="SEL" value="Search"><br><br>
        </form>   
	</body>
</html>