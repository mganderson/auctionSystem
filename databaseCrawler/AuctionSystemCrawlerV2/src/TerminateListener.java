import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.time.LocalDateTime;

public class TerminateListener implements ActionListener{
	
	@Override
	public void actionPerformed(ActionEvent e) {
		System.out.println("\n\n!!!!!!!!!!!!!!!!!!!!!!!!!!!");
        System.out.println(LocalDateTime.now() + ": Terminating Auction Crawler");
		System.exit(0);
    }
}
