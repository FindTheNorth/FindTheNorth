<?php

    function filterTable($query) {

        $server = "localhost"; // Name of server host.
        $user = "root"; // Name of server user.
        $pass = ""; // Password of server user.
        $name = "npl_database"; // Name of MySQL schema/database.

        $connection = mysqli_connect($server, $user, $pass, $name); // Store the connection which uses the above information.
        $result = mysqli_query($connection, $query); // Query the database and store the resulting rows.
        return $result;

    }

    $where_boolean = $and_boolean = $colon_boolean = false; // Set booleans to false by default
    $volume_query = $year_query = $reviewer_query = $platform_query = $franchise_query = $esrb_query = ''; // Set query string pieces to empty by default

    if (isset($_POST['Volume']) == false && isset($_POST['Year']) == false && isset($_POST['Reviewer']) == false && isset($_POST['Platform']) == false && isset($_POST['Franchise']) == false && isset($_POST['ESRB']) == false) { // If no filters have been selected ...

        $query = "SELECT * FROM npl_table;"; // Set the generic query.
        $filtered_result = filterTable($query); // Get all the ratings in the database.

    } else { // Some filters have been selected ...

        $query = "SELECT * FROM npl_table"; // Set the generic query with an open end.

        if ($_POST['Volume'] != '') { // If the Volume filter is being used ...

            if ($where_boolean == false) { // If the WHERE element hasn't been added yet before the first filter ...
                $query .= " WHERE "; // Add the WHERE element to the query.
                $where_boolean = true; // Since the WHERE element has been added, it isn't needed again, set to true to ensure future filters don't add it a second time.
            }

            if ($and_boolean == false) { $and_boolean = true; } // If this is the first filter being used, increment to let future checks know to add the AND element.

            $query .= "Volume = ".$_POST['Volume']; // Add the Volume filter to the query.
        }

        if ($_POST['Year'] != '') { // If the Year filter is being used ...

            if ($where_boolean == false) { // If the WHERE element hasn't been added yet before the first filter ...
                $query .= " WHERE "; // Add the WHERE element to the query.
                $where_boolean = true; // Since the WHERE element has been added, it isn't needed again, set to true to ensure future filters don't add it a second time.
            }

            if ($and_boolean == true) { $query .= " AND "; } // If there is a second filter to add to the query, append the AND element first.

            if ($and_boolean == false) { $and_boolean = true; } // If this is the first filter being used, increment to let future checks know to add the AND element.

            $query .= "Year = ".$_POST['Year']; // Add the Year filter to the query.
        }

        if ($_POST['Reviewer'] != '') { // If the Reviewer filter is being used ...

            if ($where_boolean == false) { // If the WHERE element hasn't been added yet before the first filter ...
                $query .= " WHERE "; // Add the WHERE element to the query.
                $where_boolean = true; // Since the WHERE element has been added, it isn't needed again, set to true to ensure future filters don't add it a second time.
            }

            if ($and_boolean == true) { $query .= " AND "; } // If there is a second filter to add to the query, append the AND element first.

            if ($and_boolean == false) { $and_boolean = true; } // If this is the first filter being used, increment to let future checks know to add the AND element.

            $query .= 'Reviewer = "'.$_POST['Reviewer'].'"'; // Add the Reviewer filter to the query.
        }

        if ($_POST['Platform'] != '') { // If the Platform filter is being used ...

            if ($where_boolean == false) { // If the WHERE element hasn't been added yet before the first filter ...
                $query .= " WHERE "; // Add the WHERE element to the query.
                $where_boolean = true; // Since the WHERE element has been added, it isn't needed again, set to true to ensure future filters don't add it a second time.
            }

            if ($and_boolean == true) { $query .= " AND "; } // If there is a second filter to add to the query, append the AND element first.

            if ($and_boolean == false) { $and_boolean = true; } // If this is the first filter being used, increment to let future checks know to add the AND element.

            $query .= 'Platform = "'.$_POST['Platform'].'"'; // Add the Platform filter to the query.
        }

        if ($_POST['Franchise'] != '') { // If the Franchise filter is being used ...

            if ($where_boolean == false) { // If the WHERE element hasn't been added yet before the first filter ...
                $query .= " WHERE "; // Add the WHERE element to the query.
                $where_boolean = true; // Since the WHERE element has been added, it isn't needed again, set to true to ensure future filters don't add it a second time.
            }

            if ($and_boolean == true) { $query .= " AND "; } // If there is a second filter to add to the query, append the AND element first.

            if ($and_boolean == false) { $and_boolean = true; } // If this is the first filter being used, increment to let future checks know to add the AND element.

            $query .= 'Franchise = "'.$_POST['Franchise'].'"'; // Add the Franchise filter to the query.
        }

        if ($_POST['ESRB'] != '') { // If the ESRB filter is being used ...

            if ($where_boolean == false) { // If the WHERE element hasn't been added yet before the first filter ...
                $query .= " WHERE "; // Add the WHERE element to the query.
                $where_boolean = true; // Since the WHERE element has been added, it isn't needed again, set to true to ensure future filters don't add it a second time.
            }

            if ($and_boolean == true) { $query .= " AND "; } // If there is a second filter to add to the query, append the AND element first.

            if ($and_boolean == false) { $and_boolean = true; } // If this is the first filter being used, increment to let future checks know to add the AND element.

            $query .= 'ESRB = "'.$_POST['ESRB'].'"'; // Add the ESRB filter to the query.
        }

        if ($colon_boolean == false) { // If the query is finished adding filters ...
            $query .= ";"; // Add the semicolon element to close the query.
            $colon_boolean = true; // Since the semicolon element has been added, it isn't needed again, set to true to ensure future filters don't add it a second time.
        }

        $filtered_result = filterTable($query); // Get all the ratings in the database that match the query.

    }

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Nintendo Power Life | Home</title>
        <link href="css/style.css" media="screen" rel="stylesheet" type="text/css"/>
	</head>
	<body>
        <div id="header">
            <h1>NINTENDO POWER <span id='life'>LIFE</span></h1>
            <h2>The unofficial aggregate site of Nintendo Power videogame reviews!</h2>
        </div>
        <div id="content">
            <h3>Who We Are</h3>
            <p>
                This website is a fan project dedicated to aggregating the game ratings made during Nintendo Power's publishing lifetime and preserving them all in one place. With this data, we are able to take that information and form statistics and trivia about the franchises, consoles, and reviewers themselves that filled Nintendo Power's pages. Every rating on this site is taken directly from physical editions of the issues we own, and we will not post any ratings from digital scans. This will ensure the integrity of the ratings we post.
            </p>
            <p>
                Nintendo Power was the official magazine for news, walkthroughs, and reviews of videogames releasing on Nintendo consoles and handhelds for over 24 years. The magazine covered content from the middle of the NES era in 1988 all the way up to the launch of the Wii U console at the end of 2012. After a 5-year hiatus from the end of this physical publishing, Nintendo Power has returned as the Nintendo Power Podcast, which continues today.
            </p>
        </div>
        <div id="content">
            <h3>Ratings</h3>
            <form method="POST" action="index.php">
                <label for="Volume">Volume:</label>
                <select name="Volume" class="volume_filter">
                    <option value="">All</option>
                    <option value="284">284</option>
                    <option value="280">280</option>
                    <option value="276">276</option>
                    <option value="275">275</option>
                    <option value="274">274</option>
                    <option value="269">269</option>
                    <option value="267">267</option>
                    <option value="266">266</option>
                    <option value="265">265</option>
                    <option value="264">264</option>
                    <option value="263">263</option>
                    <option value="262">262</option>
                    <option value="261">261</option>
                    <option value="260">260</option>
                    <option value="259">259</option>
                    <option value="258">258</option>
                    <option value="256">256</option>
                    <option value="243">243</option>
                    <option value="240">240</option>
                    <option value="239">239</option>
                    <option value="238">238</option>
                    <option value="236">236</option>
                    <option value="234">234</option>
                    <option value="228">228</option>
                    <option value="224">224</option>
                    <option value="221">221</option>
                    <option value="220">220</option>
                    <option value="219">219</option>
                    <option value="218">218</option>
                    <option value="216">216</option>
                    <option value="190">190</option>
                    <option value="189">189</option>
                    <option value="179">179</option>
                    <option value="178">178</option>
                    <option value="177">177</option>
                    <option value="176">176</option>
                    <option value="43">43</option>
                </select>
                <label for="Year">Year:</label>
                <select name="Year" class="year_filter">
                    <option value="">All</option>
                    <option value="2012">2012</option>
                    <option value="2011">2011</option>
                    <option value="2010">2010</option>
                    <option value="2009">2009</option>
                    <option value="2008">2008</option>
                    <option value="2007">2007</option>
                    <option value="2005">2005</option>
                    <option value="2004">2004</option>
                    <option value="1992">1992</option>
                </select>
                <label for="Reviewer">Reviewer:</label>
                <select name="Reviewer" class="reviewer_filter">
                    <option value="">All</option>
                    <option value="Alan Averill">Alan Averill</option>
                    <option value="Carolyn Gudmundson">Carolyn Gudmundson</option>
                    <option value="Casey Loe">Casey Loe</option>
                    <option value="Chris Hoffman">Chris Hoffman</option>
                    <option value="Christopher Shepperd">Christopher Shepperd</option>
                    <option value="Cody Martin">Cody Martin</option>
                    <option value="David Murphy">David Murphy</option>
                    <option value="Dean Royals">Dean Royals</option>
                    <option value="George Sinfield">George Sinfield</option>
                    <option value="Henry Gilbert">Henry Gilbert</option>
                    <option value="Jessica Joffe Stein">Jessica Joffe Stein</option>
                    <option value="Justin Cheng">Justin Cheng</option>
                    <option value="Nathan Meunier">Nathan Meunier</option>
                    <option value="Patrick Cunningham">Patrick Cunningham</option>
                    <option value="Phil Theobald">Phil Theobald</option>
                    <option value="Randy Nelson">Randy Nelson</option>
                    <option value="Rob Noel">Rob Noel</option>
                    <option value="Steve Thomason">Steve Thomason</option>
                    <option value="Tom Holoien">Tom Holoien</option>
                </select>
                <label for="Platform">Platform:</label>
                <select name="Platform" class="platform_filter">
                    <option value="">All</option>
                    <option value="N3DS">3DS</option>
                    <option value="Wii">Wii</option>
                    <option value="NGC">NGC</option>
                    <option value="GBA">GBA</option>
                    <option value="N64">N64</option>
                    <option value="SNES">SNES</option>
                    <option value="NES">NES</option>
                </select>
                <label for="Franchise">Franchise:</label>
                <select name="Franchise" class="franchise_filter">
                    <option value="">All</option>
                    <option value="Ace Combat">Ace Combat</option>
                    <option value="Asphalt">Asphalt</option>
                    <option value="Banjo-Kazooie">Banjo-Kazooie</option>
                    <option value="Batman">Batman</option>
                    <option value="Bleach">Bleach</option>
                    <option value="Conduit">Conduit</option>
                    <option value="Cooking Mama">Cooking Mama</option>
                    <option value="Crash Bandicoot">Crash Bandicoot</option>
                    <option value="Dance Dance Revolution">Dance Dance Revolution</option>
                    <option value="Dead Or Alive">Dead Or Alive</option>
                    <option value="Digimon">Digimon</option>
                    <option value="Donkey Kong">Donkey Kong</option>
                    <option value="Dragon Quest">Dragon Quest</option>
                    <option value="Epic Mickey">Epic Mickey</option>
                    <option value="FIFA">FIFA</option>
                    <option value="Final Fantasy">Final Fantasy</option>
                    <option value="Harry Potter">Harry Potter</option>
                    <option value="Hero">Hero</option>
                    <option value="James Bond">James Bond</option>
                    <option value="Kingdom Hearts">Kingdom Hearts</option>
                    <option value="Klonoa">Klonoa</option>
                    <option value="The Legend Of Zelda">The Legend Of Zelda</option>
                    <option value="LEGO">LEGO</option>
                    <option value="Looney Tunes">Looney Tunes</option>
                    <option value="The Lord Of The Rings">The Lord Of The Rings</option>
                    <option value="Luminous Arc">Luminous Arc</option>
                    <option value="Madden NFL">Madden NFL</option>
                    <option value="Mana">Mana</option>
                    <option value="Mario Kart">Mario Kart</option>
                    <option value="Mario Sports">Mario Sports</option>
                    <option value="Marvel">Marvel</option>
                    <option value="Medal Of Honor">Medal Of Honor</option>
                    <option value="Mega Man">Mega Man</option>
                    <option value="Metal Gear">Metal Gear</option>
                    <option value="Metroid">Metroid</option>
                    <option value="MySims">MySims</option>
                    <option value="Naruto">Naruto</option>
                    <option value="NiGHTS">NiGHTS</option>
                    <option value="Paper Mario">Paper Mario</option>
                    <option value="Phantasy Star">Phantasy Star</option>
                    <option value="Pokémon">Pokémon</option>
                    <option value="Poképark">Poképark</option>
                    <option value="Resident Evil">Resident Evil</option>
                    <option value="Rock Band">Rock Band</option>
                    <option value="Rune Factory">Rune Factory</option>
                    <option value="Shin Megami Tensei">Shin Megami Tensei</option>
                    <option value="Sid Meier">Sid Meier</option>
                    <option value="The Sims">The Sims</option>
                    <option value="Skylanders">Skylanders</option>
                    <option value="Sonic the Hedgehog">Sonic the Hedgehog</option>
                    <option value="Spongebob">Spongebob</option>
                    <option value="Star Wars">Star Wars</option>
                    <option value="Story of Seasons">Story of Seasons</option>
                    <option value="Street Fighter">Street Fighter</option>
                    <option value="Super Mario">Super Mario</option>
                    <option value="Super Monkey Ball">Super Monkey Ball</option>
                    <option value="Tales">Tales</option>
                    <option value="Tekken">Tekken</option>
                    <option value="Tom Clancy">Tom Clancy</option>
                    <option value="Transformers">Transformers</option>
                    <option value="Warriors">Warriors</option>
                    <option value="The World Ends With You">The World Ends With You</option>
                    <option value="Worms">Worms</option>
                    <option value="WWE">WWE</option>
                    <option value="Yu-Gi-Oh!">Yu-Gi-Oh!</option>
                    <option value="Zero Escape">Zero Escape</option>
                </select>
                <label for="ESRB">ESRB:</label>
                <select name="ESRB" class="ESRB_filter">
                    <option value="">All</option>
                    <option value="Everyone">Everyone</option>
                    <option value="Everyone 10+">Everyone 10+</option>
                    <option value="Teen">Teen</option>
                    <option value="Mature">Mature</option>
                </select>
                <input type="submit">
            </form>
            <br>
            <table id='ratings'>
                <tr id='columns'>
                    <th>Cover</th>
                    <th>Volume</th>
                    <th>Spine Title / Featured Game</th>
                    <th>Reviewer</th>
                    <th>Game</th>
                    <th>Rating</th>
                    <th>Platform</th>
                    <th>Franchise</th>
                    <th>Developer / Publisher</th>
                    <th>ESRB</th>
                </tr>
                <?php while ($row = mysqli_fetch_array($filtered_result)): ?>
                    <tr>
                        <td id="cover"><?php echo "<img src='assets/covers/".$row['Volume']."r.png'><br>";?></td>
                        <td><?php echo "V".$row['Volume'].": ".$row['Month']." ".$row['Year'];?></td>
                        <td><?php echo $row['Cover'];?></td>
                        <td><?php echo $row['Reviewer'];?></td>
                        <td><?php echo $row['Game'];?></td>
                        <td id="rating"><?php echo $row['Rating'];?></td>
                        <td id="platform"><?php echo "<img src='assets/consoles/".$row['Platform'].".png'><br>".$row['Platform'];?></td>
                        <td><?php echo $row['Franchise'];?></td>
                        <td><?php echo $row['Developer']." / ".$row['Publisher'];?></td>
                        <?php if ($row['ESRB'] == "Pre-ESRB") { echo "<td>Pre-ESRB</td>"; } else { echo "<td id='ESRB'><img src='assets/esrb/".$row['ESRB']."'></td>"; } ?>
                    </tr>
                <?php endwhile; ?>
            </table>
            <br>
            <?php
                $timestamp = filemtime(__FILE__);
                $date = date('F j', $timestamp);
                $year = date('Y', $timestamp);
                $day = date('j', $timestamp);
                if ($day == 1 || $day == 21 || $day == 31) {
                    echo "<strong>Last updated: ".$date."<sup style='font-size: 9px;'>st</sup>, ".$year.", by Matthew K. Fullerton</strong>";
                } else if ($day == 2 || $day == 22) {
                    echo "<strong>Last updated: ".$date."<sup style='font-size: 9px;'>nd</sup>, ".$year.", by Matthew K. Fullerton</strong>";
                } else if ($day == 3 || $day == 23) {
                    echo "<strong>Last updated: ".$date."<sup style='font-size: 9px;'>rd</sup>, ".$year.", by Matthew K. Fullerton</strong>";
                } else {
                    echo "<strong>Last updated: ".$date."<sup style='font-size: 9px;'>th</sup>, ".$year.", by Matthew K. Fullerton</strong>";
                }
            ?>
        </div>
	</body>
</html>
