import java.awt.Dimension;
import java.io.*;
import java.sql.*;
import java.time.LocalDateTime;

import javax.swing.JButton;
import javax.swing.JFrame;

public class CrawlerMain extends JFrame{
	

	public static void main(String[] args) {
		
		//Create GUI
		JFrame frame = new JFrame("Auction System Crawler");
		
		JButton terminateButton = new JButton("Press Here to Terminate Crawler");
		
		terminateButton.addActionListener(new TerminateListener());
        frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        frame.getContentPane().add(terminateButton);
        
        frame.pack();
        frame.setVisible(true);
        frame.setMinimumSize(new Dimension(400, 200));
        
		
		//set filepath for output log
		final String OUTPUTLOGFILEPATH = "/Users/michaelanderson/Desktop/";
		//set database user info:
		final String DB_USER = "root";
		final String DB_PASSWORD = "root";
		boolean goOn = true;
		
		//set up text file to log crawler activity
		LocalDateTime dateCreated = LocalDateTime.now();
		File file = new File(OUTPUTLOGFILEPATH + "AuctionCrawlerLog" + dateCreated + ".txt"); //Your file
		FileOutputStream fos = null;
		try {
			fos = new FileOutputStream(file);
		} catch (FileNotFoundException e1) {
			e1.printStackTrace();
		}
		PrintStream ps = new PrintStream(fos);
		System.setOut(ps);
		System.out.println("Auction Crawler V2 Log created on " + dateCreated);
		
		//Load the JDBC driver
		try {
			Class.forName("com.mysql.jdbc.Driver");
			System.out.println("\n" + LocalDateTime.now() + ": Driver loaded");
		} catch (ClassNotFoundException e) {
			e.printStackTrace();
		}
		
		//Connect to database
		Connection connection = null;
		try {
			connection = DriverManager.getConnection("jdbc:mysql://localhost:8889/auction_system", DB_USER, DB_PASSWORD);
			System.out.println(LocalDateTime.now() + ": Database connected");
		} catch (SQLException e) {
			e.printStackTrace();
		}
		
		//instantiate CrawlerLooper
		CrawlerLooper cl = new CrawlerLooper(connection);

		//begin loop
		while(goOn){
			cl.loop();
		}
		
		try {
			connection.close();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
				

	}
	
	

}
