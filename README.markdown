# Currents

[My website](http://johnholdun.com) is real simple. A couple sentences, a couple more sentences, and some links.

I was inspired by [Analog](http://analog.coop) to add some *dynamic content* to half of those sentences. One of them is my latest tweet that starts with "I" (e.g. "I am telling you about my website.") Another mentions what city I'm in, courtesy of my [Dopplr](http://dopplr.com) account.

That pulled tweet has some extra magic, too. Any \*asterisks\* are turned into \<em>emphasis\</em>, and if there's a URL at the end of the message, the whole thing is turned into a proper hyperlink. I also went through the trouble of tying in the Bit.ly API  to expand those URLs when necessary. I'm not sure that I'l ever, ever have a chance to actually use this.

I also cache this data in a JSON file so it's only called hourly at most, and then those links on the page are in there too for some reason.

Finally, I went through the trouble of commenting everything and pulling out the sensitive information (API keys and the like) into a separate file because I figured if I've gone this far, why not git-push?

THIS WAS SUPPOSED TO BE SO SIMPLE. LOOK AT WHAT YOU MADE ME DO.