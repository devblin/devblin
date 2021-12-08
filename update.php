<?php
    function breakSentence($str, $limit) {
        $new_str = "";
        if(strlen($str) >= $limit) {
            for ($i = 0; $i < strlen($str); $i += $limit) { 
                $new_str .= substr($str, $i, $limit)." <br> ";
            }
        } else {
            $new_str = $str;
        }
        return $new_str;
    }
    date_default_timezone_set("Asia/Kolkata");
    $api_url = "https://zenquotes.io/api/today";

    //Sending GET request to $api_url
    $request = curl_init($api_url);
    curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($request, CURLOPT_HEADER, 0);
    $quote = curl_exec($request);
    curl_close($request);

    //Decoding JSON string to Object
    $quote = json_decode($quote, true)[0];
    $quote_content = breakSentence($quote['q'], 75);    
    $quote_author = $quote['a'];

    //Date to Friday 21, 2021 format
    $date = date("Y-m-d h:i:s");
    $date = date("F j, Y, g:i a", strtotime($date));

    //Readme data to update
    $hello = "# Hello 👋\n\n";
    $recent = "🌱 In pandemic. <br> ⚡ Fun fact: Lazy.\n\n";
    $profile_views = "<img src=\"https://komarev.com/ghpvc/?username=devblin&color=010409\"></img>";
    $quote_area = "<hr>\n<div align=\"center\"><b><h3>\"$quote_content\"</h3></b><br><i> - $quote_author</i></div>\n<hr>\n\n";
    $center_align_start = "<p align=\"center\">\n"; 
    $github_stats = "\t<img src=\"https://github-readme-stats.vercel.app/api?username=devblin&count_private=true&show_icons=true&hide_border=true&bg_color=00000000&text_color=3790D7&title_color=FF2D2D&icon_color=fb8c00&include_all_commits=true&custom_title=📙 Deepanshu Dhruw's Github Stats\">\n";
    $most_lang = "\t<img src=\"https://github-readme-stats.vercel.app/api/top-langs/?username=devblin&layout=compact&hide=&langs_count=10&hide_border=true&bg_color=00000000&text_color=3790D7&title_color=FF2D2D&icon_color=fb8c00&custom_title=💻 Most Used Languages\">\n";
    $streak_stats = "\t<img src=\"https://github-readme-streak-stats.herokuapp.com?user=devblin&theme=dark&hide_border=true&background=00000000&stroke=FF2D2D&ring=FF2D2D&currStreakLabel=3790D7&dates=3790D7&currStreakNum=3790D7&sideNums=3790D7&sideLabels=3790D7\">\n";
    $wakatime = "\t<img src=\"https://github-readme-stats.vercel.app/api/wakatime?username=devblin&layout=compact&theme=dark&hide_border=true&bg_color=00000000&text_color=3790D7&title_color=FF2D2D&langs_count=20&custom_title=⏳ Wakatime Stats\">\n";
    $center_align_end = "</p>\n\n";
    $last_updated = "<br><br><kbd>Last updated: $date</kbd>";

    //Read README.md
    $readme = fopen("README.md", "w");
    $readme_content = $profile_views.$quote_area.$last_updated;
    fwrite($readme, $readme_content);
    fclose($readme);
?>
