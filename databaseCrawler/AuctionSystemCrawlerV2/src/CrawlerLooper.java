import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.time.LocalDateTime;

public class CrawlerLooper {
	
	private Connection connection;
	
	public CrawlerLooper(Connection connection){
		this.connection = connection;
	}
	
	public void loop(){
		System.out.println("\n\n" + LocalDateTime.now() + ": Begin loop of database queries");
		
		//QUERY FOR SUCCESSFUL AUCTIONS
		
		//Instantiate a Statement
		Statement statement = null;
		try {
			statement = connection.createStatement();
		} catch (SQLException e) {
			e.printStackTrace();
		}

		//Instantiate a result set in preparation for SQL query results
		ResultSet successfulAuctionSet = null;
		try {
			//resultSet = statement.executeQuery("SELECT `title` FROM `Auction`");
			//get auctions that have expired with bids
			successfulAuctionSet = statement.executeQuery
					("SELECT   `title`, "
							+ "`auctionPK`,"
							+ "`auctionOwnerFK`,"
							+ "`Auction`.`dateCreated` + `auctionLength` + `deadline` AS `ContractDeadline`,"
							+ "bidOwnerFK,"
							+ "bidAmt"
							+ "  FROM `Auction` "
							+ "INNER JOIN `Bid` ON `Auction`.`lowBidFK` = `Bid`.`bidPK`"
							+ "WHERE `Auction`.`dateCreated` + `Auction`.`auctionLength` < UNIX_TIMESTAMP() "
							+ "AND `active`=1 "
							+ "AND `successfullyCompleted`=0");
		} catch (SQLException e) {
			e.printStackTrace();
		}
		
		String title;
		String auctionFK;
		String consumerFK;
		String serviceProviderFK;
		String contractPrice;
		String deadline;
		
		//Iterate through the result, store values in variables, prepare query and insert new contracts in database
		try {
			while(successfulAuctionSet.next()){			
				//Store values of each result row in variables
				title = successfulAuctionSet.getString(1);
				auctionFK = successfulAuctionSet.getString(2);
				consumerFK = successfulAuctionSet.getString(3);
				serviceProviderFK = successfulAuctionSet.getString(5);
				contractPrice = successfulAuctionSet.getString(6);
				deadline = successfulAuctionSet.getString(4);
				
				//Print PKs of successful auctions to Log
				System.out.println("\n\t" + LocalDateTime.now() + ": Auction number " + auctionFK + " (" + title + ") is successful");
				
				//instantiate Statement object
				Statement createContractStatement = null;
				try {
					createContractStatement = connection.createStatement();
				} catch (SQLException e) {
					e.printStackTrace();
				}
				
				//create insert statement for contract
				String sqlInsertStatement = String.format("INSERT INTO `Contract` (`title`, `auctionFK`, `consumerFK`, `serviceProviderFK`, `contractPrice`, `deadline`) "
												 	+ "VALUES ('%s',%s, %s, %s, %s, %s)", title, auctionFK, consumerFK, serviceProviderFK, contractPrice, deadline);
				//System.out.println(sqlInsertStatement);
				
				//Execute insert statement for contract
				createContractStatement.executeUpdate(sqlInsertStatement);
				//Print confirmation of contract creation to log
				System.out.println("\t" + LocalDateTime.now() + ": Contract created for Auction number " + auctionFK + " (" + title + ")");
				
				
				
				// Set value of `active` column to 0 for each successful auction and value of `successfullyCompleted` to 1
				
				//instantiate Statement object
				Statement updateAuctonStatement = null;
				try {
					updateAuctonStatement = connection.createStatement();
				} catch (SQLException e) {
					e.printStackTrace();
				}
				//Create update statement
				String sqlUpdateStatement = String.format("UPDATE `Auction` "
														+ "SET `active`=0, `successfullyCompleted`=1 "
														+ "WHERE `auctionPK`=%s ", auctionFK);				
				//Execute update statement
				updateAuctonStatement.executeUpdate(sqlUpdateStatement);
				//Print confirmation of status update to log
				System.out.println("\t" + LocalDateTime.now() + ": Column `active` set to 0 and column `successfullyCompleted` set to 1 for Auction number " + auctionFK + " (" + title + ")");
				
			}
		} catch (SQLException e) {
			e.printStackTrace();
		}
			
		//Instantiate a result set in preparation for SQL query results
		ResultSet unsuccessfulAuctionSet = null;
		try {
			//get auctions that have expired without bids
			unsuccessfulAuctionSet = statement.executeQuery
					("SELECT   `auctionPK`, "
							+ "`title` "
							+ "FROM `Auction` "
							+ "WHERE `Auction`.`dateCreated` + `Auction`.`auctionLength` < UNIX_TIMESTAMP() "
							+ "AND `Auction`.`lowBidFK` IS NULL "
							+ "AND `active`=1 "
							+ "AND `successfullyCompleted`=0");
		} catch (SQLException e) {
			e.printStackTrace();
		}
		
		
		//Iterate through the result and print the auction titles
		try {
			while(unsuccessfulAuctionSet.next()){
				//System.out.println(unsuccessfulAuctionSet.getString(1));
				auctionFK = unsuccessfulAuctionSet.getString(1);
				title = unsuccessfulAuctionSet.getString(2);
				
				//Print PKs of unsuccessful auctions to Log
				System.out.println("\n\t" + LocalDateTime.now() + ": Auction number " + auctionFK + " (" + title + ") is unsuccessful");
				
				//Set value of `active` column to 0 for each unsuccessful auction
				
				//instantiate Statement object
				Statement updateAuctonStatement2 = null;
				try {
					updateAuctonStatement2 = connection.createStatement();
				} catch (SQLException e) {
					e.printStackTrace();
				}
				//Create update statement
				String sqlUpdateStatement = String.format("UPDATE `Auction` "
														+ "SET `active`=0, `successfullyCompleted`=0 "
														+ "WHERE `auctionPK`=%s ", auctionFK);				
				//Execute update statement
				updateAuctonStatement2.executeUpdate(sqlUpdateStatement);
				//Print confirmation of status update to log
				System.out.println("\t" + LocalDateTime.now() + ": Column `active` set to 0 for Auction number " + auctionFK + " (" + title + ")\n");
				
			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
		//TODO end loop
		System.out.println(LocalDateTime.now() + ": End loop of database queries");
		
		//Go to sleep for 60 seconds
		try {
			System.out.println(LocalDateTime.now() + ": Going to sleep for 60 seconds");
			Thread.sleep(60000);
			System.out.println("---------------\n");
			
		} catch (InterruptedException e1) {
			e1.printStackTrace();
		}
	}
}
