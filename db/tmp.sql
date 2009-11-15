SELECT matches.id, results.id, results.team1_score, results.team2_score, grouptables.id result_id FROM matches
LEFT JOIN results ON results.match_id = matches.id AND results.matchpart_id = 1
JOIN grouptables ON matches.grouptable_id = grouptables.id
WHERE grouptables.event_id = 30 


