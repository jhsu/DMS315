drop table if exists enemies;

CREATE TABLE enemies (
	id INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(100),
	description VARCHAR(255),
	rank INT UNIQUE NOT NULL,
	PRIMARY KEY(id)
);

insert into enemies(name, rank) 
values( 'Arnold M. Picker', 1),
 ('Alexander E. Barkan', 2),
 ('Edwin Guthman', 3),
 ('Maxwell Dane', 4),
 ('Charles Dyson', 5),
 ('Howard Stein', 6),
 ('Allard Lowenstein', 7),
 ('Morton Halperin', 8),
 ('Leonard Woodcock', 9),
 ('S. Sterling Munro, Jr.', 10);

/*
	Bernard T. Feld, president, Council for a Livable World: Heavy far left funding. They will program an “all court press” against us in ’72.
	Sidney Davidoff, New York City, Lindsay’s top personal aide: a first class S.O.B., wheeler-dealer and suspected bagman. Positive results would really shake the Lindsay camp and Lindsay’s plans to capture youth vote. Davidoff in charge.
	John Conyers, congressman, Detroit: Coming on fast. Emerging as a leading black anti-Nixon spokesman. Has known weakness for white females.
	Samuel M. Lambert, president, National Education Association: Has taken us on vis-a-vis federal aid to parochial schools—a ’72 issue.
	Stewart Rawlings Mott, Mott Associates New York: Nothing but big money for radic-lib candidates.
	Ron Dellums, congressman, California: Had extensive EMK-Tunney support in his election bid. Success might help in California next year.
	Daniel Schorr, Columbia Broadcasting System, Washington: A real media enemy.
	S. Harrison Dogole, Philadelphia, Pennsylvania: President of Globe Security Systems—fourth largest private detective agency in U.S. Heavy Humphrey contributor. Could program his agency against us.
	Paul Newman, California-Connecticut: Radic-lib causes. Heavy McCarthy involvement ’68. Used effectively in nationwide T.V. commercials. ’72 involvement certain.
	Mary McGrory, Washington columnist: Daily hate Nixon articles.
	)
	*/
