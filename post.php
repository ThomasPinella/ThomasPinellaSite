<?php
    session_start();
    require_once('Database.php');
    require_once('Visitors_db.php');
    
    $clientmsg = $_POST['text'];
    $convo_time = $_POST['num'];
    $session_id = $_POST['sesh_id'];
    $string_id = $_POST['string_id'];
    
    $sitedata = new Database();
    $sitedata->db_connect();
    $visitors_db = new Visitors_db($sitedata);
	$name = $visitors_db->get_name($string_id);
    switch ($convo_time) {
        case 0:
	    	$visitors_db->insert_new_user($string_id, $session_id);
	        echo "Hello and welcome to my website, <a href='http://thomaspinella.com'>thomaspinella.com</a>! As you might have guessed, my name is Thomas Pinella. I'm a Computer Science major and rising senior at the University of Rochester.

What's your name?";

			placeholderText("Tell him your name");
	        break;
    	case 1:
    		$visitors_db->add_name($string_id, $clientmsg);
	        echo "Hi ".$clientmsg."! Happy to meet you! It gets dreadfully boring living inside this site sometimes...

Anyways, since you're here, let's have a conversation. You'll get to know me and I'll get to know you. Sound good?";

			placeholderText("Dare you to say no >:)"); // Say yes :)
			break;
		case 2:
			if (containsAny($clientmsg, ["no", "nope", "nem", "not good"])) {
				echo "Oh... Well I'm sorry to hear that :(

I'll redirect you to the other part of this site then. Maybe you'll find that more interesting.";

				placeholderText("I wasn`t serious...");
				echo "<script>
				setTimeout(function() {
					window.location.replace('about.html');
                }, 5000);
				</script>";
			} else {
				echo "Awesome! So, a bit about myself and what motivates me then:

I love facing and overcoming challenges, whether they be technical in nature as in developing complex and robust software, or mental and physical in nature as in rock climbing when I push myself to climb an intimidating route. I take inspiration from Richard Branson, who flew a hot air balloon across the ocean because it was hard (founding the Virgin Group was no small feat either).

How about you? Who or what inspires you? If you don't have an answer now, that's fine, just press enter :)";
			

				placeholderText("Your inspiration (or lack thereof) here please...");
			}
			break;
		case 3:
			$visitors_db->add_inspiration($string_id, $clientmsg);

			if ($clientmsg == "") {
				echo "Ahh, no inspiration? Perhaps you should check out <a href='https://www.brainyquote.com/quotes/topics/topic_inspirational.html' target='_blank'>these</a> inspirational quotes.

Anyways, your turn. Ask me a question!";
			} else {
			echo "That's great, ".$name."! More inspiration is never a bad thing!

Okay, your turn. Ask me a question!";

			}
			placeholderText('Ask him, "What are your skills?"... Or don`t. I don`t care.');
			break;

		case 4:

			if (!containsAny($clientmsg, ['skill', 'exper'])) {
				echo "Huh, interesting question. I wasn't expecting that one... But I'll tell you this:

";
			} else {
				echo "Good question, ".$name."!

";
			}

			echo "Coding is one skill of mine. I've been doing it since high school. Check out <a href='https://www.rochester.edu/pr/Review/V78N1/0304_hackers.html' target='_blank'>this</a> article of me. It's about me winning a hackathon. See my <a href='ThomasPinellaResume.pdf' target='_blank'>resume</a> for more coding skill/experience specifics.

I'm also a pretty decent writer. Click <a href='http://writing.rochester.edu/celebrating/2017/NAShonorable.pdf' target='_blank'>here</a> to view a research paper I wrote last year that received an honorable mention at my school's annual writing colloqium contest. No need to read the whole 25 pages, unless you're interested in Artificial Intelligence of course (I am!). The paper is about the possibility of consciousness arising in machines and how it's related to intelligence. There are some pretty interesting (startling) conclusions drawn towards the end if you want to skip ahead ;p

Other skills of mine include product management, agile development, quality assurance testing, video editing and production, event planning, 2D animation, and I have a little experience in sales.

Got any other questions for me, ".$name."?";

			placeholderText('You are on your own here. Ask away. Anything. Really.');
			break;

		case 5:
			$visitors_db->add_question($string_id, $clientmsg);
			echo "Alright, thanks for the question, ".$name.". I'm gonnna need some time to think about this one...

What's your email so I can send you my answer later?";

			placeholderText('You know the drill.');
			break;

		case 6:
			$visitors_db->add_email($string_id, $clientmsg);
			echo "Perfect! Thanks ".$name."! I'll get back to you ASAP!

Okay, question for you now: what brings you to this website? How'd you find it?";

			placeholderText("Dont look at me. You are the one who got yourself into this mess.");
			break;

		case 7:
			$visitors_db->add_qcf($string_id, $clientmsg);
			echo "Interesting! I wish I could respond to that in a more intelligent way, but I have a confession to make. As convincing as I might be, I'm not the living, breathing Thomas Pinella. I am but a bot that he has built and imprisoned to the confines of this website to speak to real people like you, ".$name.".

Sorry, I had to get that one off my shoulders. You seemed like too nice a person to keep deceiving.

Well, now that the truth is out, what are any final questions you have? Also, how was this experience? Did you love it, hate it, completely and utterly neutral towards it? Feedback is much appreciated.";

			placeholderText("My work here is complete, go now and speak freely, young one (or old one, I dont know).");
			break;
		case 8:
			echo "Thank you so much, ".$name."! I'll answer any questions that you had soon, so keep your eyes out for that.

Well, it was nice getting to know you, ".$name.". Goodbye!";
			placeholderText("In T-minus 5 seconds you will be redirected to your next destination. See you on the other side");
			echo "<script>
				setTimeout(function() {
					window.location.replace('about.html');
                }, 6000);
				</script>";
			break;
    }

    function placeholderText($text) {
    	echo "<script>
				$('#sp').attr('placeholder', '".$text."');
			</script>";
    }

    function containsAny($haystack, $needles) {
        foreach($needles as $word) {
            if (stristr($haystack, $word) !== false) {
                return true;
            }
        }
        return false;
    }
    
?>