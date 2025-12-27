========================================
ALMA MATER AUDIO FILE INSTRUCTIONS
========================================

To complete the Alma Mater karaoke section on the home page:

1. Place your Alma Mater MP3 file in this directory
2. Name it: alma-mater.mp3
3. The full path should be: public/audio/alma-mater.mp3

The karaoke player will automatically:
- Play the music when the play button is clicked
- Highlight lyrics in sync with the song (adjust timing in the HTML if needed)
- Show a progress bar
- Allow volume control
- Auto-scroll to current lyrics

To adjust lyric timing:
- Edit the "data-time" attribute in each lyric line
- Time is in seconds from the start of the song
- Example: data-time="5" means the line appears at 5 seconds

File located at: resources/views/public/index.blade.php (lines 305-440)
