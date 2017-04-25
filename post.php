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
	    	//$visitors_db->insert_new_user($string_id, $session_id);
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
			} else {
				echo "Awesome! So, a bit about myself and what motivates me then:

I love facing and overcoming challenges, whether they be technical in nature as in developing complex and robust software, or mental and physical in nature as in rock climbing when I push myself to climb an intimidating route. I take inspiration from Richard Branson, who flew a hot air balloon across the ocean because it was hard (founding the Virgin Group was no small feat either).

How about you? Who or what inspires you? If you don't have an answer now, that's fine, just press enter :)";
			}

			placeholderText("Your inspiration (or lack thereof) here please...");
			break;
		case 3:
			$visitors_db->add_inspiration($string_id, $clientmsg);
			echo "That's great, ".$name."! More inspiration is never a bad thing!

Ok, your turn. Ask me a question!";

			placeholderText('Ask him, "What are your skills?"... Or dont. I dont care.');
			break;

		case 4:
			echo "Good question, ".$name."!

Coding is one skill of mine. I've been doing it since high school. Check out this article of me. It's about me winning a hackathon. See my resume here for more coding skill/experience specifics.

I'm also a pretty decent writer. Click here to view a research paper I wrote last year that received an honorable mention at my school's annual writing colloqium contest. No need to read the whole 25 pages, unless you're interested in Artificial Intelligence of course (I am!). The paper is about the possibility of consciousness arising in machines and how it's related to intelligence. There are some pretty interesting (startling) conclusions drawn towards the end if you want to skip ahead ;p

Other skills of mine include product management, agile development, quality assurance testing, video editing and production, event planning, 2D animation, and I have a little experience in sales.

Got any other questions for me, ".$name."?";

			placeholderText('You are on your own here. Ask away. Anything. Really.');
			break;

		case 5:
			echo "Alright, thanks for the question, ".$name.". I'm gonnna need some time to think about this one...

What's your email so I can send you my answer later?";

			placeholderText('Do I really need to spell it out for you?');
			break;

		case 6:
			$name = "";//$visitors_db->get_name($string_id);
			//$visitors_db->add_email($string_id, $clientmsg);
			echo "Perfect! Thanks ".$name."! I'll get back to you ASAP!

Okay, question for you now: what brings you to this website? How'd you find it?";

			placeholderText("Dont look at me. You're the one who got yourself into this mess.");
			break;

		case 7:
			$visitors_db->add_qcf($string_id, $clientmsg);
			echo "Interesting! I wish I could respond to that in a more intelligent way, but I have a confession to make. As convincing as I might be, I'm not the living, breathing Thomas Pinella. I am but a bot that he has built and imprisoned to the confines of this website to speak to real people like you, ".$name.".

Sorry, I had to get that one off my shoulders. You seemed like too nice a person to keep deceiving. Well, now that the truth is out, what are any final questions you have? Also, how was this experience? Did you love it, hate it, completely and utterly neutral towards it? Feedback is much appreciated.";

			placeholderText("My job here is complete, go now and speak freely, young one (or old one, I dont know).");
			break;
		case 8:
			echo "Thank you so much, ".$name."! I'll answer any questions that you had soon, so keep your eyes out for that.

Well, it was nice getting to know you, ".$name.". Goodbye!";
			placeholderText("");
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