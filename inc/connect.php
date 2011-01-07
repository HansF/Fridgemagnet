<?php 
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

$db = mysql_select_db("shop", $con);



// just a handy validator 
function isvalidean13($input){
	preg_match('/\d{4}/', $input, $matches);
	$check = $matches[0];
	if ($check == $input) return true;
	}
	

function EanToCash($input){
	$amount = substr($input, 2, 2);
	return $input; 
}


function EanToUser($input){
		$sql = "SELECT * FROM `users` WHERE ean='".$input."' LIMIT 0, 1 ";
		$result = mysql_query($sql);
		if (mysql_num_rows ($result) == 1){
					$row = mysql_fetch_assoc($result);
					return $row['id']; 
					}else{
					return false; 
					}
}

function GetAccountBalanceById($input){
		$sql = "SELECT sum(`amount`) as total FROM `transactions` LEFT JOIN users ON (users.id = transactions.user) WHERE `users`.id = $input group by `user`";
		//echo $sql;
		$result = mysql_query($sql);
		if (mysql_num_rows ($result) == 1){
					$row = mysql_fetch_assoc($result);
					return $row['total']; 
					}else{
					return false; 
					}
}




function GiveQuote(){
	$dqs[]="Stay busy, get plenty of exercise, and don't drink too much.&#160; Then again, don't drink too little.&#160; ~Herman &#34;Jackrabbit&#34; Smith-Johannsen";
	$dqs[]="Always do sober what you said you'd do drunk.&#160; That will teach you to keep your mouth shut.&#160; ~Ernest Hemingway";
	$dqs[]="A hangover is the wrath of grapes.&#160; ~Author Unknown";
	$dqs[]="I prefer to think that God is not dead, just drunk.&#160; ~John Marcellus Huston";
	$dqs[]="If you must drink and drive, drink Pepsi.&#160; ~Author unknown, as seen on a bumper sticker";
	$dqs[]="Draft beer, not people.&#160; ~Author Unknown";
	$dqs[]="The first thing in the human personality that dissolves in alcohol is dignity.&#160; ~Author Unknown";
	$dqs[]="Wine is bottled poetry.&#160; ~Robert Louis Stevenson<!--COCI-->";
	$dqs[]="When the wine goes in, strange things come out.&#160; ~Johann Christoph Friedrich von Schiller, <i>The Piccolomini</i>, 1799<!--, act 2, scene 12, MBT p33-->";
	$dqs[]="If drinking is interfering with your work, you're probably a heavy drinker.&#160; If work is interfering with your drinking, you're probably an alcoholic.&#160; ~Author Unknown";
	$dqs[]="If you know someone who tries to drown their sorrows, you might tell them sorrows know how to swim.&#160; ~Quoted in <i>P.S. I Love You</i>, compiled by H. Jackson Brown, Jr.";
	$dqs[]="O God, that men should put an enemy in their mouths to steal away their brains! that we should, with joy, pleasance, revel, and applause, transform ourselves into beasts!&#160; ~William Shakespeare, <i>Othello</i><!--, act II, scene 3; MCTO-->";
	$dqs[]="First you take a drink, then the drink takes a drink, then the drink takes you.&#160; ~Francis Scott Key Fitzgerald<!--PMB, p289; quoted in Jules Feiffer, <i>Ackroyd</i>, 1977, 7 May 1964-->";
	$dqs[]="I think a man ought to get drunk at least twice a year just on principle, so he won't let himself get snotty about it.&#160; ~Raymond Chandler";
	$dqs[]="If four or five guys tell you that you're drunk, even though you know you haven't had a thing to drink, the least you can do is to lie down a little while.&#160; ~Joseph Schenck";
	$dqs[]="This is one of the disadvantages of wine:&#160; it makes a man mistake words for thought.&#160; ~Samuel Johnson<!--COCI-->";
	$dqs[]="One reason I don't drink is that I want to know when I am having a good time.&#160; ~Lady Astor<!--CUL-->";
	$dqs[]="A man who was fond of wine was offered some grapes at dessert after dinner.&#160; &#34;Much obliged,&#34; said he, pushing the plate aside, &#34;I am not accustomed to take my wine in pills.&#34;&#160; ~Jean Anthelme Brillat-Savarin";
	$dqs[]="Once, during Prohibition, I was forced to live for days on nothing but food and water.&#160; ~W.C. Fields";
	$dqs[]="It is most absurdly said, in popular language, of any man, that he is disguised in liquor; for, on the contrary, most men are disguised by sobriety.&#160; ~Thomas de Quincy, <i>Confessions of an English Opium-Eater</i>, 1856<!--WLBUQ-->";
	$dqs[]="It takes 8,460 bolts to assemble an automobile, and one nut to scatter it all over the road.&#160; ~Author unknown, as seen on a bumper sticker";
	$dqs[]="The harsh, useful things of the world, from pulling teeth to digging potatoes, are best done by men who are as starkly sober as so many convicts in the death-house, but the lovely and useless things, the charming and exhilarating things, are best done by men with, as the phrase is, a few sheets in the wind.&#160; ~H.L. Mencken, <i>Prejudices, Fourth Series</i>, 1924<!--CTO-->";
	$dqs[]="Your body is a temple, but keep the spirits on the outside.&#160; ~Author Unknown";
	$dqs[]="You don't have to be a beer drinker to play darts, but it helps.&#160; ~Author Unknown<!--DCD-->";
	$dqs[]="I like liquor - its taste and its effects - and that is just the reason why I never drink it.&#160; ~Thomas Jackson<!--DCMOO-->";
	$dqs[]="Sometimes when I reflect back on all the beer I drink I feel ashamed.&#160; Then I look into the glass and think about the workers in the brewery and all of their hopes and dreams.&#160; If I didn't drink this beer, they might be out of work and their dreams would be shattered.&#160; Then I say to myself, it is better that I drink this beer and let their dreams come true than be selfish and worry about my liver.&#160; ~Jack Handey";
	$dqs[]="When the wine is in, the wit is out.&#160; ~Proverb";
	$dqs[]="I feel sorry for people who don't drink.&#160; When they wake up in the morning, that's as good as they're going to feel all day.&#160; ~Frank Sinatra";
	$dqs[]="I like to keep a bottle of stimulant handy in case I see a snake, which I also keep handy.&#160; ~W.C. Fields";
	$dqs[]="Woman first tempted man to eat; he took to drinking of his own accord.&#160; ~<i>Four Hundred Laughs: Or, Fun Without Vulgarity</i>, compiled and edited by John R. Kemble, 1902";
	$dqs[]="Without question, the greatest invention in the history of mankind is beer.&#160; Oh, I grant you that the wheel was also a fine invention, but the wheel does not go nearly as well with pizza.&#160; ~Dave Barry";
	$dqs[]="Drinking makes such fools of people, and people are such fools to begin with, that it's compounding a felony.&#160; ~Robert Benchley<!--PCR-->";
	$dqs[]="The chief reason for drinking is the desire to behave in a certain way, and to be able to blame it on alcohol.&#160; ~Mignon McLaughlin, <i>The Neurotic's Notebook</i>, 1960<!--CDN-->";
	$dqs[]="I envy people who drink - at least they know what to blame everything on.&#160; ~Oscar Levant<!--COCI-->";
	$dqs[]="Remember:&#160; &#34;I&#34; before &#34;E,&#34; except in Budweiser.&#160; ~Author Unknown";
	$dqs[]="Champagne, if you are seeking the truth, is better than a lie detector.&#160; It encourages a man to be expansive, even reckless, while lie detectors are only a challenge to tell lies successfully.&#160; ~Graham Greene<!--COCI-->";
	$dqs[]="No animal ever invented anything so bad as drunkeness - or so good as drink.&#160; ~Lord Chesterton";
	$dqs[]="Even though a number of people have tried, no one has yet found a way to drink for a living.&#160; ~Jean Kerr<!--ClV-->";
	$dqs[]="We borrowed golf from Scotland as we borrowed whiskey.&#160; Not because it is Scottish, but because it is good.&#160; ~Horace Hutchinson<!--CG-->";
	$dqs[]="Drunkenness is temporary suicide.&#160; ~Bertrand Russell, <i>The Conquest of Happiness</i><!--WLBUQ-->";
	$dqs[]="Everybody should believe in something; I believe I'll have another drink.&#160; ~Author Unknown";
	$dqs[]="Wine gives a man nothing... it only puts in motion what had been locked up in frost.&#160; ~Samuel Johnson";
	$dqs[]="I don't think I've ever drunk champagne before breakfast before.&#160; With breakfast on several occasions, but never before before.&#160; ~From the movie <i>Breakfast at Tiffany's</i>, 1961, screenplay by George Axelrod, based on the novella by Truman Capote, spoken by the character Paul Varjak";
	$dqs[]="A man ought not never to get drunk above the neck.&#160; ~Author Unknown";
	$dqs[]="Wine is sunlight, held together by water.&#160; ~Galileo<!--COCI-->";
	$dqs[]="If you wish to keep your affairs secret, drink no wine.&#160; ~Author Unknown<!--CTO-->";
	$dqs[]="They speak of my drinking, but never think of my thirst.&#160; ~Scottish Proverb";
	$dqs[]="Bacchus has drowned more men than Neptune.&#160; ~Giuseppe Garibaldi<!--MCTO-->";
	$dqs[]="A woman drove me to drink and I never even had the courtesy to thank her.&#160; ~W.C. Fields";
	$dqs[]="Zen martini:&#160; A martini with no vermouth at all.&#160; And no gin, either.&#160; ~P.J. O'Rourke<!--NEMYL-->";
	$dqs[]="Beer is the cause and solution to all of life's problems.&#160; ~Homer Simpson";
	$dqs[]="Hefeweizen.&#160; Never drink something you can't spill.&#160; ~Steve Miller";
	$dqs[]="I'm going to be around until the Atomic Energy Commission finds a safe place to bury my liver.&#160; ~Phil Harris<!--, on how long he will continue to golf--><!--CG-->";
	$dqs[]="Drunkenness is nothing but voluntary madness.&#160; ~Seneca<!--MCTO-->";
	$dqs[]="Whoever takes just plain ginger ale soon gets drowned out of the conversation.&#160; ~Kin Hubbard<!--CUL-->";
	$dqs[]="If we take habitual drunkards as a class, their heads and their hearts will bear an advantageous comparison with those of any other class.&#160; There seems ever to have been a proneness in the brilliant and warm-blooded to fall in to this vice.&#160; The demon of intemperance ever seems to have delighted in sucking the blood of genius and generosity.&#160; ~Abraham Lincoln, address to the Washington Temperance Society, Springfield, Illinois, 22 February 1842<!--MHC-->";
	$dqs[]="I drink only to make my friends seem interesting.&#160; ~Don Marquis<!--NEMYL-->";
	$dqs[]="Be wary of strong drink.&#160; It can make you shoot at tax collectors... and miss.&#160; ~Robert Heinlein";
	$dqs[]="I'd prefer to have a full bottle in front of me than a full frontal lobotomy.&#160; ~Frank Nicholson, attributed<!--DCMOO-->";
	$dqs[]="Why don't you slip out of those wet clothes and into a dry Martini?&#160; ~Robert Benchley<!--NEMYL-->é";
	$dqs[]="When I read about the evils of drinking, I gave up reading.&#160; ~Henny Youngman";
	$dqs[]="My grandmother is over eighty and still doesn't need glasses.&#160; Drinks right out of the bottle.&#160; ~Henny Youngman";
	$dqs[]="A drunken man is fitly named: he has drank, till he is drunken: the wine swallows his consciousness, and it sinks therein.&#160; ~Augustus William Hare and Julius Charles Hare, <i>Guesses at Truth, by Two Brothers</i>, 1827";
	$dqs[]="I have taken more out of alcohol than alcohol has taken out of me.&#160; ~Winston Churchill";
	$dqs[]="Of the demonstrably wise there are but two:&#160; those who commit suicide, and those who keep their reasoning faculties atrophied by drink.&#160; ~Mark Twain, <i>Note-Book</i>, 1935<!--WLBUQ-->";
	$dqs[]="Teetotallers lack the sympathy and generosity of men that drink.&#160; ~W.H. Davies<!--DCMOO-->";
	$dqs[]="Brandy, n.&#160; A cordial composed of one part thunder-and-lightning, one part remorse, two parts bloody murder, one part death-hell-and-the-grave and four parts clarified Satan.&#160; ~Ambrose Bierce<!--NEMYL-->";
	$dqs[]="Drink the first.&#160; Sip the second slowly.&#160; Skip the third.&#160; ~Knute Rockne";
	$dqs[]="If you drink, don't drive.&#160; Don't even putt.&#160; ~Dean Martin";
	$dqs[]="Wine gives courage and makes men more apt for passion.&#160; ~Ovid<!--COCI-->";
	$dqs[]="Life's a waste of time, time's a waste of life so let's all get wasted and have the time of our life.&#160; ~Author Unknown";
	$dqs[]="Health - what my friends are always drinking to before they fall down.&#160; ~Phyllis Diller<!--WL-->";
	$dqs[]="No poems can please for long or live that are written by water-drinkers.&#160; ~Horace (Quintus Horatius Flaccus), <i>Satires</i><!--, 35 B.C., book 1, satire 19, line 2; PMB, p262-->";
	$dqs[]="Everyone who drinks is not a poet.&#160; Some of us drink because we're not poets.&#160; ~From the movie <i>Arthur</i>";
	$dqs[]="How come if alcohol kills millions of brain cells, it never killed the ones that made me want to drink?&#160; ~Author Unknown";
	$dqs[]="One martini is all right.&#160; Two are too many, and three are not enough.&#160; ~James Thurber<!--NEMYL-->";
	$dqs[]="If you are young and you drink a great deal it will spoil your health, slow your mind, make you fat - in other words, turn you into an adult.&#160; ~P.J. O'Rourke";
	$dqs[]="Beer is proof that God loves us and wants us to be happy.&#160; ~Author unknown, commonly attributed to Benjamin Franklin";
	$dqs[]="Never cry over spilt milk.&#160; It could've been whiskey.&#160; ~&#34;Pappy&#34; Maverick, in <i>Maverick</i>";
	$i = rand ( 0 , 79 );
	return $dqs[$i];
}

?>