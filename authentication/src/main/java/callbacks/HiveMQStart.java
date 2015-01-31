
package callbacks;

import com.dcsquare.hivemq.spi.callback.CallbackPriority;
import com.dcsquare.hivemq.spi.callback.events.broker.OnBrokerStart;
import com.dcsquare.hivemq.spi.callback.exception.BrokerUnableToStartException;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;

import java.sql.*;
import java.util.ArrayList;

public class HiveMQStart implements OnBrokerStart {

    Logger log = LoggerFactory.getLogger(HiveMQStart.class);

    Connection connectionpub = null;
    Statement statementpub = null;
    ResultSet resultSetpub = null;
    ArrayList pos_coordinate = new ArrayList();


    @Override
    public void onBrokerStart() throws BrokerUnableToStartException {
        log.info("HiveMQ is starting");
        pos_coordinate.clear();

        try{
            System.out.println("Connecting to database..");
            Class.forName("com.mysql.jdbc.Driver");
            connectionpub = DriverManager.getConnection("jdbc:mysql://us-cdbr-east-04.cleardb.com:3306/ad_8c8d158234a92d0", "b4ae5754215d7e", "507f4753");
            System.out.println("Connection Successful");
            statementpub = connectionpub.createStatement();
            resultSetpub = statementpub.executeQuery("SELECT positioncoordinates FROM registerdevice");

            while (resultSetpub.next())
            {
                pos_coordinate.add(resultSetpub.getString("positioncoordinates"));
            }
            System.out.println(pos_coordinate);

        }
        catch(ClassNotFoundException error){
            System.out.println("Error :" + error.getMessage());
        }
        catch(SQLException error)
        {
            System.out.println("Error:" + error.getMessage());
        }
        finally{
            if (connectionpub !=null) try{connectionpub.close();} catch(SQLException ignore){}
            if (statementpub !=null) try{statementpub.close();} catch(SQLException ignore){}
            if (resultSetpub !=null) try{resultSetpub.close();} catch(SQLException ignore){}
        }


    }
    @Override
    public int priority() {
        return CallbackPriority.MEDIUM;
    }
}
