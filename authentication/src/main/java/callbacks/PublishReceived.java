package callbacks;

import com.dcsquare.hivemq.spi.callback.CallbackPriority;
import com.dcsquare.hivemq.spi.callback.events.OnPublishReceivedCallback;
import com.dcsquare.hivemq.spi.callback.exception.OnPublishReceivedException;
import com.dcsquare.hivemq.spi.message.PUBLISH;
import com.dcsquare.hivemq.spi.security.ClientData;
import com.fasterxml.jackson.databind.JsonNode;
import com.fasterxml.jackson.databind.ObjectMapper;
import com.google.common.base.Charsets;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;

import java.io.*;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.util.ArrayList;

public class PublishReceived extends HiveMQStart implements OnPublishReceivedCallback {

    Logger logger = LoggerFactory.getLogger(PublishReceived.class);

    String topic;
    String trafficpos;
    String message;
    String direction;
    String parsedMessage;
    int distanceValue;
    ArrayList calculated_distance = new ArrayList();
    String subscribeMessage;
    byte[] subscribeArray;
    boolean flag = false;


    @Override
    public void onPublishReceived(PUBLISH publish, ClientData clientData) throws OnPublishReceivedException {
        //pos_coordinate.clear();
        calculated_distance.clear();
        String clientID = clientData.getClientId();
        topic = publish.getTopic();
        message = new String(publish.getPayload(), Charsets.UTF_8);


        logger.info("Client " + clientID + " sent a message to topic " + topic + ": " + message);

        if(topic.equals("emergency"))
        {
        direction = message.substring(message.lastIndexOf(',') + 1);
        parsedMessage = message.substring(0, message.length() - 2);

        //System.out.println("Current Position coordinates : " + parsedMessage);
        //System.out.println("Current Direction : " + direction);

        DistanceCalc();
        System.out.println("Calculated distances: " + calculated_distance);

        if(flag == true)
        {
            publish.setTopic(trafficpos);
            publish.setPayload(subscribeArray);
            calculated_distance.clear();
            //pos_coordinate.clear();
            flag = false;
        }

            try {
                SendCoordinates();
            } catch (IOException e) {
                e.printStackTrace();
            }

            calculated_distance.clear();
        //pos_coordinate.clear();
        }
}


    public void DistanceCalc() {
        String DISTANCE_CALC_URL = "http://maps.googleapis.com/maps/api/distancematrix/json?";

        try {
                for (int i=0; i<pos_coordinate.size(); i++)
                {
                    URL url = new URL(DISTANCE_CALC_URL + "origins=" + parsedMessage + "&destinations=" + pos_coordinate.get(i) + "&sensor=false");
                    HttpURLConnection conn = (HttpURLConnection) url.openConnection();
                    conn.connect();

                    BufferedReader reader = new BufferedReader(new InputStreamReader(conn.getInputStream()));

                    ObjectMapper mapper = new ObjectMapper();
                    JsonNode node = mapper.readTree(reader);

                    //System.out.println(node);

                    JsonNode rows = node.path("rows").get(0);
                    JsonNode elements = rows.path("elements").get(0);
                    JsonNode distance = elements.path("distance");
                    JsonNode text = distance.path("value");
                    distanceValue = text.intValue();
                    //System.out.println(distanceValue);

                    calculated_distance.add(distanceValue);
                        if(distanceValue < 150)
                        {
                            System.out.println("Traffic light found");
                            if (direction.equals("N")){
                                subscribeMessage = "Green North";
                                subscribeArray = subscribeMessage.getBytes();
                                //publish.setPayload(subscribeArray);
                                System.out.println("Topic to publish : " + pos_coordinate.get(i));
                                String pos= pos_coordinate.get(i).toString();
                                trafficpos = pos;
                                flag = true;
                                break;
                            }
                            else if (direction.equals("S")){
                                subscribeMessage = "Green South";
                                subscribeArray = subscribeMessage.getBytes();
                                //publish.setPayload(subscribeArray);
                                System.out.println(pos_coordinate.get(i));
                                String pos= pos_coordinate.get(i).toString();
                                trafficpos = pos;
                                flag = true;
                                break;
                            }
                            else if (direction.equals("E")){
                                subscribeMessage = "Green East";
                                subscribeArray = subscribeMessage.getBytes();
                                //publish.setPayload(subscribeArray);
                                System.out.println(pos_coordinate.get(i));
                                String pos= pos_coordinate.get(i).toString();
                                trafficpos = pos;
                                flag = true;
                                break;
                            }
                            else if (direction.equals("W")){
                                subscribeMessage = "Green West";
                                subscribeArray = subscribeMessage.getBytes();
                                //publish.setPayload(subscribeArray);
                                System.out.println(pos_coordinate.get(i));
                                String pos= pos_coordinate.get(i).toString();
                                trafficpos = pos;
                                flag = true;
                                break;
                            }

                        }

                }

            }
        catch (MalformedURLException error) {
                System.out.println("Error:" + error.getMessage());
            }
        catch (IOException error) {
                System.out.println("Error:" + error.getMessage());
            }

    }


    public void SendCoordinates() throws IOException {

        URL url_dash = new URL("http://m2mdashboard.cfapps.io/getcoordinates.php");
        HttpURLConnection dash_conn = (HttpURLConnection) url_dash.openConnection();

        HttpURLConnection.setFollowRedirects(true);
        dash_conn.setDoOutput(true);
        dash_conn.setRequestMethod("POST");

        PrintStream ps = new PrintStream(dash_conn.getOutputStream());
        ps.print("location="+parsedMessage);
        ps.print("&topic="+topic);

        dash_conn.getInputStream();
        ps.close();

    }

    @Override
    public int priority() {
        return CallbackPriority.MEDIUM;
    }



}
