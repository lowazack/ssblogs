<?php


  function twitterFeed($postNum = 30)
	{
		// Check key values are set
		if(empty($pageName) || empty($appToken) || empty($appSecret) || empty($consumerKey) || empty($consumerSecret))
		{
      // Access the config values

      $pageName = "pcprotecthelp";
      $appToken = "727431158846373889-Ds42zzFStp7XOnxL79R0A00RTDsB0Da";
      $appSecret = "qWoImo3HeNcq3L56FprTC9M1gKhM5IrLjqq6UYgB3UZOp";
      $consumerKey = "HSNWjx3wJuUdokDMBibTBspUh";
      $consumerSecret = "HEpGrZM5V1p5q5v1EyEq3zPBlMu1ohgNDIhc1zyZ9MzT1vaPox";
		}


		$base = get_template_directory();

		// A script that handles the authentication process
		require_once("{$base}/twitter-api/TwitterAPIExchange.php");

		/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
		// Access tokens for authenticating with the twitter api
		$settings = [
			'oauth_access_token' => $appToken,
			'oauth_access_token_secret' => $appSecret,
			'consumer_key' => $consumerKey,
			'consumer_secret' => $consumerSecret
		];

		$type = [
			'/statuses/user_timeline.json', // All your tweets or the tweets of the user you specify.
			'/statuses/mentions_timeline.json', // All the tweets in which another Twitter user mentions you.
			'/statuses/home_timeline.json', // All the tweets from the people you follow
			'/search/tweets.json', // A Twitter search with the query you specify
		];

		// Base url for the twitter api
		$url = "https://api.twitter.com/1.1{$type[0]}";

		// Custom parameters to pass to twitter
		$rawParams = [
			'screen_name' => $pageName,
			'count' => $postNum,
      'tweet_mode' => 'extended',
      "exclude_replies" => true,
		];

		// turn array into a url get parameters
		$params = http_build_query($rawParams);

		// Prepend with "?"
		$query = "?{$params}";

		// Set request method
		$requestMethod = [
			"GET",
			"POST",
		];

		// Instansiate the API handler & pass in the credentials
		$twitter = new TwitterAPIExchange($settings);

		// JSON encoded response
		$response = $twitter
			->setGetfield($query)
			->buildOauth($url, $requestMethod[0])
			->performRequest();

		// Decode the json into an object
		return $response;
	}

?>

<div class="sidebar-card sidebar-card--drop-shadow" id="latestTweets">
  <div class="sidebar-card__title">
    <i class="fab fa-twitter sidebar-card__twitter-icon"></i>
    Latest Tweets
  </div>
  <hr>
</div>

<script type="text/javascript">
  var posts = <?= twitterFeed() ?>;
  var recentThree = [];

  for (var i = 0; i < posts.length; i++) {
    if (recentThree.length > 2) {
      break;
    }
    var post = posts[i];
    if (hasHashtag(post['entities']['hashtags'], "SCGN")) {
      continue;
    }
    recentThree.push(post);

  }

  function hasHashtag(entities, value) {
    for (var inc = 0; inc < entities.length; inc++) {
      entity = entities[inc];
      if (entity['text'] == value) {
        return true;
      }
    }
    return false;
  }

  $(document).ready(function () {
    for (var i = 0; i < recentThree.length; i++) {
      var post = recentThree[i];
      $('#latestTweets').append($('<p style="font-size: 14px;"></p>')
                  .append($('<i class="fab fa-twitter" style="color: #df1616;"></i>'))
                  .append("<a href='https://twitter.com/" + post['user']['screen_name'] + "' style='color: #df1616;'>" + "@" + post['user']['screen_name'] + "</a>")
                  .append(function () {
                    var returnText = post['full_text'];

                    if (post['entities']['urls'].length > 0) {
                      for (var i = 0; i < post['entities']['urls'].length; i++) {
                        returnText = returnText.replace(post['entities']['urls'][i]['url'], '');
                      }
                    }

                    if (post['entities']['hashtags'].length > 0) {
                      for (var i = 0; i < post['entities']['hashtags'].length; i++) {
                        returnText = returnText.replace("#" + post['entities']['hashtags'][i]['text'], "");
                      }
                    }
                    returnText = returnText.substring(0, 100);
                    var elipses = '...';
                    if (returnText.endsWith('...', returnText.length)) {
                      elipses = '';
                    }
                    return " " + returnText + elipses + "<a target='_blank' href='https://twitter.com/" + post['user']['screen_name'] + "/status/" + post['id_str'] + "'>More</a>";
                  })
        )
        .append(function () {
          if (i > 1) {
            return '';
          }
          else {
            return '<span class=\"line-seperator\"></span>';
          }
        });
    }
  });

</script>
