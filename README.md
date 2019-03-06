# Project 2
+ By: *Nathan Hunt*.
+ Production URL: <http://p2.nhunt.me>.

## Outside resources
+ I got some general PHP advice and reference from *Learning PHP : a Gentle Introduction to the Web's Most Popular Language* by David Sklar.

## Notes for instructor
+ The W3 validator produces several warnings for my site. Some of them are because my `section` tags don't have headers, but that's by design. Most of the rest of them are because I use html `id` attributes for the piano keys, and the W3 validator is flagging the fact that the `ids` are duplicated. This was a design decision to create a two-octave piano—I simply added the HTML string to itself in PHP. In a more perfect world with more time, I might revisit my decision, but for now it's at least functional. 
